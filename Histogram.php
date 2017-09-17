<?php

class Histogram {

    /**
     * Get all candidates
     *
     * @param none
     * @return array
     */
    public function getCandidates() {
        $candidates = [];

        $fname = "datasrc/cn.txt";
        $handle = fopen($fname, "r") or die("Couldn't get handle");

        if ($handle) {
            while (!feof($handle)) {
                $line = fgets($handle, 4096);
                if ($line):
                    $data = explode("|", $line);
                    $candidates[$data[0]] = $data[1];
                endif;
            }
            fclose($handle);
        }

        arsort($candidates); /* Sorting array */
        return $candidates;
    }

    /**
     * param $cand_id
     * @return array of Hostogram Data
     */
    public function getHistogramData($cand_id) {
        $histogramData = [];
        $contributions = $this->getContributionByCandId($cand_id);
        foreach ($contributions as $value1 => $value2) {
            $histogramData[] = [$value1, $value2];
        }
        return $histogramData;
    }

    /**
     * @return array of contributions
     */
    private function getContributionByCandId($cand_id = null) {
        $contributions = [];

        if (is_null($cand_id)) {
            return $contributions;
        }

        $fname = "datasrc/itpas2.txt";
        $handle = fopen($fname, "r") or die("Couldn't get handle");

        if ($handle) {
            while (!feof($handle)) {
                $line = fgets($handle, 4096);
                if ($line):
                    $data = explode("|", $line);
                    if ($data[16] !== $cand_id) {
                        continue;
                    }
                    if (isset($contributions[$data[14]])) {
                        $contributions[$data[14]] ++;
                    } else {
                        $contributions[$data[14]] = 1;
                    }
                endif;
            }

            fclose($handle);
        }

        return $contributions;
    }

}
