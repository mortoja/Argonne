<?php

class Histogram {

    /**
     * Get all candidates
     *
     * @param none
     * @return array
     */
    public function getCandidates() {
        $candidateMasterData = file(__DIR__ . '/datasrc/cn.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $candidates = [];
        foreach ($candidateMasterData as $line) {
            $data = explode("|", $line);
            $candidates[$data[0]] = $data[1];
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
        //reading the file to find out the contribution
        $contributionsData = file(__DIR__ . '/datasrc/itpas2.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($contributionsData as $line) {
            $data = explode("|", $line);

            if ($data[16] !== $cand_id) {
                continue;
            }

            if (isset($contributions[$data[14]])) {
                $contributions[$data[14]] ++;
            } else {
                $contributions[$data[14]] = 1;
            }
        }

        return $contributions;
    }

}
