# Histogram

A histogram is an accurate graphical representation of the distribution of numerical data. In this project we analyze txt file to generate histogram supplied by Federal Election Commission. These files contain committee, candidate and campaign finance data for the current election cycle and for election cycles through 1980. It is important to be careful when making conclusions from these data because some information may not have completed the entry process when these files where created.

## How to Install
This project utilizes [Composer](https://getcomposer.org/) to manage its dependencies. So, before installing the project, make sure you have Composer installed on your machine.

Run the following commands in composer: 

```
- git clone https://github.com/mortoja/histogram.git

- composer install
```

## Getting Started

You can select candidate from select box to generate a histogram. It is important to note that all candidate does not have campaign finance data. Some example candidates with data available are listed below

* Womack, Steve: ```CAND_ID=H0AR03055```
* Brooks, Mo: ```CAND_ID=H0AL05163```
* Flake, Jeff Mr.: ```CAND_ID=H0AZ01184```

#### Note

Some weird behavior is observed in the process text file. In some cases the transection amount contain negative values. For example one of the row of a user (SEWELL, TERRYCINA ANDREA, CAND_ID=H0AL07086) is

```
C00193631|A|M12|P|201609209032011113|24K|CCM|TERRI SEWELL FOR CONGRESS|BIRMINGHAM|AL|35201|||11302015|-2500|C00458976|H0AL07086|38790382|1100750||VOID - TERRI SEWELL FOR CONGRESS|4092320161323741372
```

Here ```-2500``` is transaction amount

