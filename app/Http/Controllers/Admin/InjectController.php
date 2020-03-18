<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use DataTables;
use Auth;
use Alert;
use App\Models\Icon;
use Illuminate\Support\Facades\DB;

class InjectController extends Controller
{

  public function run(Request $request)
  {
    try {
      $datas = array(
        0 => array(
          'No' => '1',
          'ID' => 'M1903001159',
          'username' => 'ahuatyao',
          'B Sponsor' => '0',
          'B Pairing' => '582000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '582000'
        ),
        1 => array(
          'No' => '2',
          'ID' => 'M1903001114',
          'username' => 'aldo2',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        2 => array(
          'No' => '3',
          'ID' => 'M1903001115',
          'username' => 'aldo3',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        3 => array(
          'No' => '4',
          'ID' => 'M1903000964',
          'username' => 'aldoadela',
          'B Sponsor' => '0',
          'B Pairing' => '487500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '487500'
        ),
        4 => array(
          'No' => '5',
          'ID' => 'M1906003085',
          'username' => 'alexanderjana',
          'B Sponsor' => '1008800',
          'B Pairing' => '97000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1105800'
        ),
        5 => array(
          'No' => '6',
          'ID' => 'M1904001335',
          'username' => 'alvzzz',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        6 => array(
          'No' => '7',
          'ID' => 'M1809000002',
          'username' => 'anastasiamirna',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        7 => array(
          'No' => '8',
          'ID' => 'M1810000081',
          'username' => 'andreasg',
          'B Sponsor' => '0',
          'B Pairing' => '4777500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '4777500'
        ),
        8 => array(
          'No' => '9',
          'ID' => 'M1903000858',
          'username' => 'andreyhariyanto',
          'B Sponsor' => '0',
          'B Pairing' => '1072500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1072500'
        ),
        9 => array(
          'No' => '10',
          'ID' => 'M1903001026',
          'username' => 'andreyhariyanto1991',
          'B Sponsor' => '0',
          'B Pairing' => '780000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '780000'
        ),
        10 => array(
          'No' => '11',
          'ID' => 'M1809000004',
          'username' => 'andygunawan',
          'B Sponsor' => '0',
          'B Pairing' => '682500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '682500'
        ),
        11 => array(
          'No' => '12',
          'ID' => 'M2002007179',
          'username' => 'Andysenjaya',
          'B Sponsor' => '2017600',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '2017600'
        ),
        12 => array(
          'No' => '13',
          'ID' => 'M1912005513',
          'username' => 'ansel',
          'B Sponsor' => '1014000',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1111500'
        ),
        13 => array(
          'No' => '14',
          'ID' => 'M2002006586',
          'username' => 'apin',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        14 => array(
          'No' => '15',
          'ID' => 'M1903001201',
          'username' => 'apriyao',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        15 => array(
          'No' => '16',
          'ID' => 'M1810000052',
          'username' => 'ardykaanggriawan',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        16 => array(
          'No' => '17',
          'ID' => 'M1901000642',
          'username' => 'aripraja',
          'B Sponsor' => '1014000',
          'B Pairing' => '195000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1209000'
        ),
        17 => array(
          'No' => '18',
          'ID' => 'M1904001707',
          'username' => 'ariskris01',
          'B Sponsor' => '0',
          'B Pairing' => '388000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '388000'
        ),
        18 => array(
          'No' => '19',
          'ID' => 'M1903000908',
          'username' => 'aryearye',
          'B Sponsor' => '0',
          'B Pairing' => '2925000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '2925000'
        ),
        19 => array(
          'No' => '20',
          'ID' => 'M2001006500',
          'username' => 'beth_santoso',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        20 => array(
          'No' => '21',
          'ID' => 'M1906003202',
          'username' => 'billionaire',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        21 => array(
          'No' => '22',
          'ID' => 'M1904001449',
          'username' => 'bimasakti',
          'B Sponsor' => '0',
          'B Pairing' => '195000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '195000'
        ),
        22 => array(
          'No' => '23',
          'ID' => 'M1912005744',
          'username' => 'blaxert',
          'B Sponsor' => '6084000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '6084000'
        ),
        23 => array(
          'No' => '24',
          'ID' => 'M2002007170',
          'username' => 'bless168',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        24 => array(
          'No' => '25',
          'ID' => 'M1912005565',
          'username' => 'Boedih01',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        25 => array(
          'No' => '26',
          'ID' => 'M2002006642',
          'username' => 'BOSTON123',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        26 => array(
          'No' => '27',
          'ID' => 'M1905001944',
          'username' => 'calmag_united',
          'B Sponsor' => '0',
          'B Pairing' => '97000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '97000'
        ),
        27 => array(
          'No' => '28',
          'ID' => 'M2002007162',
          'username' => 'cellalin2094',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        28 => array(
          'No' => '29',
          'ID' => 'M2002007139',
          'username' => 'charlesp32',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        29 => array(
          'No' => '30',
          'ID' => 'M1905001916',
          'username' => 'cherryalicia',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        30 => array(
          'No' => '31',
          'ID' => 'M1908003925',
          'username' => 'culan1986',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        31 => array(
          'No' => '32',
          'ID' => 'M1910004760',
          'username' => 'dananjaya',
          'B Sponsor' => '1014000',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1111500'
        ),
        32 => array(
          'No' => '33',
          'ID' => 'M2002006813',
          'username' => 'davidadnan',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        33 => array(
          'No' => '34',
          'ID' => 'M1904001337',
          'username' => 'davidoff',
          'B Sponsor' => '0',
          'B Pairing' => '292500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '292500'
        ),
        34 => array(
          'No' => '35',
          'ID' => 'M1910004822',
          'username' => 'dearypraditya',
          'B Sponsor' => '0',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '2910000',
          'Tax' => '3.0%',
          'cash' => '2910000'
        ),
        35 => array(
          'No' => '36',
          'ID' => 'M1906002570',
          'username' => 'dennykwan2704',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        36 => array(
          'No' => '37',
          'ID' => 'M2002006882',
          'username' => 'Dillonnatalino',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        37 => array(
          'No' => '38',
          'ID' => 'M1906002889',
          'username' => 'edyson_chai',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        38 => array(
          'No' => '39',
          'ID' => 'M2001006387',
          'username' => 'eldora',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        39 => array(
          'No' => '40',
          'ID' => 'M1810000038',
          'username' => 'fatmawati',
          'B Sponsor' => '0',
          'B Pairing' => '292500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '292500'
        ),
        40 => array(
          'No' => '41',
          'ID' => 'M1909004716',
          'username' => 'feinsuwira',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        41 => array(
          'No' => '42',
          'ID' => 'M1809000006',
          'username' => 'feliowijoyo',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        42 => array(
          'No' => '43',
          'ID' => 'M2002006916',
          'username' => 'Femmytoar',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        43 => array(
          'No' => '44',
          'ID' => 'M1906002601',
          'username' => 'fikarioadiyuda',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        44 => array(
          'No' => '45',
          'ID' => 'M1909004589',
          'username' => 'franco02',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        45 => array(
          'No' => '46',
          'ID' => 'M1907003868',
          'username' => 'friskifernando2',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        46 => array(
          'No' => '47',
          'ID' => 'M2001006129',
          'username' => 'Great_GGE',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        47 => array(
          'No' => '48',
          'ID' => 'M2002006973',
          'username' => 'handrianir',
          'B Sponsor' => '11096800',
          'B Pairing' => '291000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '11387800'
        ),
        48 => array(
          'No' => '49',
          'ID' => 'M1909004712',
          'username' => 'hansel23',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        49 => array(
          'No' => '50',
          'ID' => 'M1904001545',
          'username' => 'helenirawati',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        50 => array(
          'No' => '51',
          'ID' => 'M1903001010',
          'username' => 'hendrik.narto',
          'B Sponsor' => '0',
          'B Pairing' => '390000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '390000'
        ),
        51 => array(
          'No' => '52',
          'ID' => 'M1903000953',
          'username' => 'henry',
          'B Sponsor' => '0',
          'B Pairing' => '1852500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1852500'
        ),
        52 => array(
          'No' => '53',
          'ID' => 'M2002006846',
          'username' => 'Hermilya',
          'B Sponsor' => '3042000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '3042000'
        ),
        53 => array(
          'No' => '54',
          'ID' => 'M1905002015',
          'username' => 'hovenhoven',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        54 => array(
          'No' => '55',
          'ID' => 'M1911005087',
          'username' => 'howanto',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        55 => array(
          'No' => '56',
          'ID' => 'M2001005911',
          'username' => 'indahswari',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        56 => array(
          'No' => '57',
          'ID' => 'M1912005411',
          'username' => 'irenelaw',
          'B Sponsor' => '3026400',
          'B Pairing' => '194000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '3220400'
        ),
        57 => array(
          'No' => '58',
          'ID' => 'M2001006376',
          'username' => 'ivanaefata01',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        58 => array(
          'No' => '59',
          'ID' => 'M1901000482',
          'username' => 'ivanboncon',
          'B Sponsor' => '0',
          'B Pairing' => '1940000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1940000'
        ),
        59 => array(
          'No' => '60',
          'ID' => 'M1904001494',
          'username' => 'ivanxan',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        60 => array(
          'No' => '61',
          'ID' => 'M2002007173',
          'username' => 'Jason2',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        61 => array(
          'No' => '62',
          'ID' => 'M2002007135',
          'username' => 'Jimmywijaya',
          'B Sponsor' => '3042000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '3042000'
        ),
        62 => array(
          'No' => '63',
          'ID' => 'M1904001652',
          'username' => 'jozu',
          'B Sponsor' => '0',
          'B Pairing' => '195000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '195000'
        ),
        63 => array(
          'No' => '64',
          'ID' => 'M2002006854',
          'username' => 'juliantio',
          'B Sponsor' => '4056000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '4056000'
        ),
        64 => array(
          'No' => '65',
          'ID' => 'M1912005743',
          'username' => 'JUNK1EZ',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        65 => array(
          'No' => '66',
          'ID' => 'M1912005218',
          'username' => 'kenzokenzo',
          'B Sponsor' => '0',
          'B Pairing' => '97000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '97000'
        ),
        66 => array(
          'No' => '67',
          'ID' => 'M2002006986',
          'username' => 'Kevintanu',
          'B Sponsor' => '3042000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '3042000'
        ),
        67 => array(
          'No' => '68',
          'ID' => 'M1906002630',
          'username' => 'khosiujing',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        68 => array(
          'No' => '69',
          'ID' => 'M1911005016',
          'username' => 'kristantilaksmi01',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        69 => array(
          'No' => '70',
          'ID' => 'M1903000895',
          'username' => 'laurencrisya',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        70 => array(
          'No' => '71',
          'ID' => 'M1912005222',
          'username' => 'lawirene',
          'B Sponsor' => '0',
          'B Pairing' => '390000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '390000'
        ),
        71 => array(
          'No' => '72',
          'ID' => 'M1902000829',
          'username' => 'loalex',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        72 => array(
          'No' => '73',
          'ID' => 'M1910004781',
          'username' => 'lyuwono',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        73 => array(
          'No' => '74',
          'ID' => 'M1912005749',
          'username' => 'Magnum7',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        74 => array(
          'No' => '75',
          'ID' => 'M1901000675',
          'username' => 'margarethharlim',
          'B Sponsor' => '1014000',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1111500'
        ),
        75 => array(
          'No' => '76',
          'ID' => 'M1905001891',
          'username' => 'michaeljs',
          'B Sponsor' => '0',
          'B Pairing' => '195000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '195000'
        ),
        76 => array(
          'No' => '77',
          'ID' => 'M1809000001',
          'username' => 'mr_den_sularso',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        77 => array(
          'No' => '78',
          'ID' => 'M1907003751',
          'username' => 'naomibennely',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        78 => array(
          'No' => '79',
          'ID' => 'M1905001970',
          'username' => 'nova_rida',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        79 => array(
          'No' => '80',
          'ID' => 'M2002007098',
          'username' => 'pongs',
          'B Sponsor' => '2028000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '2028000'
        ),
        80 => array(
          'No' => '81',
          'ID' => 'M1906003182',
          'username' => 'preciliamaria',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        81 => array(
          'No' => '82',
          'ID' => 'M1903001116',
          'username' => 'rendytan1',
          'B Sponsor' => '1008800',
          'B Pairing' => '194000',
          'B Profit' => '0',
          'B Reward' => '2910000',
          'Tax' => '3.0%',
          'cash' => '4112800'
        ),
        82 => array(
          'No' => '83',
          'ID' => 'M1912005443',
          'username' => 'rinaldolee',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        83 => array(
          'No' => '84',
          'ID' => 'M2002006775',
          'username' => 'RISH89',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        84 => array(
          'No' => '85',
          'ID' => 'M1905001826',
          'username' => 'rqyzhen',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        85 => array(
          'No' => '86',
          'ID' => 'M1904001369',
          'username' => 'santoso',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        86 => array(
          'No' => '87',
          'ID' => 'M1910004818',
          'username' => 'shalvygui',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        87 => array(
          'No' => '88',
          'ID' => 'M2001005963',
          'username' => 'siauwhar2911',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        88 => array(
          'No' => '89',
          'ID' => 'M1912005758',
          'username' => 'Skyline',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        89 => array(
          'No' => '90',
          'ID' => 'M1903000933',
          'username' => 'stanleyk1121',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        90 => array(
          'No' => '91',
          'ID' => 'M1905002394',
          'username' => 'stefheni',
          'B Sponsor' => '0',
          'B Pairing' => '97500',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '97500'
        ),
        91 => array(
          'No' => '92',
          'ID' => 'M2002007111',
          'username' => 'Suryani',
          'B Sponsor' => '1008800',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '1008800'
        ),
        92 => array(
          'No' => '93',
          'ID' => 'M1905001894',
          'username' => 'suyantoking14',
          'B Sponsor' => '0',
          'B Pairing' => '390000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '390000'
        ),
        93 => array(
          'No' => '94',
          'ID' => 'M2002007196',
          'username' => 'THEINX99',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
        94 => array(
          'No' => '95',
          'ID' => 'M1904001445',
          'username' => 'tiozhg',
          'B Sponsor' => '8070400',
          'B Pairing' => '776000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '8846400'
        ),
        95 => array(
          'No' => '96',
          'ID' => 'M1902000824',
          'username' => 'wisuri',
          'B Sponsor' => '0',
          'B Pairing' => '195000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '195000'
        ),
        96 => array(
          'No' => '97',
          'ID' => 'M1904001336',
          'username' => 'wwwbatumuliadotcom',
          'B Sponsor' => '0',
          'B Pairing' => '291000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '3.0%',
          'cash' => '291000'
        ),
        97 => array(
          'No' => '98',
          'ID' => 'M1902000809',
          'username' => 'yonathan',
          'B Sponsor' => '0',
          'B Pairing' => '195000',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '195000'
        ),
        98 => array(
          'No' => '99',
          'ID' => 'M1903001246',
          'username' => 'zerowithin',
          'B Sponsor' => '1014000',
          'B Pairing' => '0',
          'B Profit' => '0',
          'B Reward' => '0',
          'Tax' => '0,025',
          'cash' => '1014000'
        ),
      );

      $count = 0;

      foreach($datas as $member) {
        DB::beginTransaction();

        $employeer = DB::table('employeers')->where('id_member', $member['ID'])->first();

        if($employeer) {
          $history = DB::table('history_bitrex_cash')->insert([
            'id_member' => $employeer->id,
            'nominal' => $member['cash'],
            'description' => 'Manual Withdraw',
            'info' => 0,
            'type' => 5,
            'created_at' => '2020-03-03 17:27:38'
          ]);

          $decrement = DB::table('employeers')->where('id', $employeer->id)->decrement('bitrex_cash', (int) $member['cash']);

          if($history && $decrement) {
            $count++;
            DB::commit();
            echo "Sukses insert untuk ID  $employeer->id <br/>";
          } else {
            DB::rollBack();
            echo "Gagal insert untuk ID  $employeer->id <br/>";
          }
        }
      }

      echo "Sukses insert $count ID";
    } catch (\Exception $e) {
      echo "Kesalahan Insert";
    }
  }

  public function runJob(Request $request)
  {
    try {
      DB::beginTransaction();
      $datas = [
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001114',
          'cash' => 97500
        ],
        [
          'member' => 'M1903001115',
          'cash' => 1014000
        ],
        [
          'member' => 'M1903000964',
          'cash' => 487500
        ],
        [
          'member' => 'M1906003085',
          'cash' => 1105800
        ],
        [
          'member' => 'M1904001335',
          'cash' => 1014000
        ],
        [
          'member' => 'M1809000002',
          'cash' => 97500
        ],
        [
          'member' => 'M1810000081',
          'cash' => 4777500
        ],
        [
          'member' => 'M1903000858',
          'cash' => 1072500
        ],
        [
          'member' => 'M1903001026',
          'cash' => 780000
        ],
        [
          'member' => 'M1809000004',
          'cash' => 682500
        ],
        [
          'member' => 'M2002007179',
          'cash' => 2017600
        ],
        [
          'member' => 'M1912005513',
          'cash' => 1111500
        ],
        [
          'member' => 'M2002006586',
          'cash' => 1008800
        ],
        [
          'member' => 'M1903001201',
          'cash' => 97500
        ],
        [
          'member' => 'M1810000052',
          'cash' => 97500
        ],
        [
          'member' => 'M1901000642',
          'cash' => 1209000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
        [
          'member' => 'M1903001159',
          'cash' => 582000
        ],
      ];

    } catch (\Exception $e) {
      DB::rollBack();
    }
  }

}