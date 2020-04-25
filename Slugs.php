<?php
/**
 * @author: paraksh Joshi
  * @url github/theprakashchandra
 */


class Slugs
{

  var $rules;

  public function __construct() {


  }

  function index(){

    header('Content-type: text/html; charset=utf-8');
    /*
    * @var string put anything inside this string var
    */
    $string = "";
    echo $this->get_slug($string,'-');
  }


  public function get_slug($string , $seprator='-'){
    $string = trim($string);
    $string = mb_strtolower($string, "UTF-8");
    $string = preg_replace("/[^a-z0-9_ोौेैा्ीिीूुंःअआइईउऊएऐओऔकखगघचछजझञटठडढतथदधनपफबभमयरलवसशषहश्रक्षटठडढङणनऋ\s-]/u", "", $string);

    //translate if string in other language (hindi);
      $newStr = $this->translate($string);

      $newStr = preg_replace("/[\s-]+/", " ", $newStr);
      $newStr = preg_replace("/[\s_]/", $seprator, $newStr);
      //return this value
      return mb_strtolower($newStr);
  }


  public function translate($string){
    //translated to english

    $this->set_rules();

    //break the string
    $strChars = $this->mbStringToArray($string);

    $newStr = "";
    $strChars = $this->joinVarnamala(  $strChars);
      // var_dump($strChars);
    foreach ($strChars as $key => $value) {
       if (array_key_exists(  $value, $this->rules )) {
          $newStr .= $this->rules[$value];
       }
       else {
         $newStr .= $value;
       }
    }
    return $newStr;
  }

/* this function not used in this class */
  function mb_str_split( $string ) {
    # Split at all position not after the start: ^
    # and not before the end: $
    return preg_split('/(?<!^)(?!$)/u', $string );
  }

/*
  *@code form stackoverflow and some modification made
*/
  function mbStringToArray ($string) {
  $strlen = mb_strlen($string);
  while ($strlen) {
      $array[] = mb_substr($string,0,1,"UTF-8");
      $string = mb_substr($string,1,$strlen,"UTF-8");
      $strlen = mb_strlen($string);
  }
      return $array;
  }

  function joinVarnamala($array){
    $this->set_rules();
    $singsArray=array("ि","्","ो","े","्","ौ","ै","ा","ी","ू","ु");
    $out=array($array[0]);

    for ($i=1; $i <count($array) ; $i++) {
        if (in_array($array[$i], $singsArray)) {
          if (array_key_exists( $out[count($out)-1].$array[$i], $this->rules )) {
              $out[count($out)-1].= $array[$i];
          }
        }else{
            $out[]=$array[$i];
          }
        }
        return $out;
  }

  public function set_rules($lang = 'hi'){
    $this->rules = array(
        'अ' => 'a',
        'आ' => 'aa',
        'इ' => 'i',
        'ई' => 'ee',
        'उ' => 'u',
        'ऊ' => 'uu',
        'ए'  => 'e',
        'ऐ' => 'ai',
        'ओ' => 'o',
        'औ' => 'ou',
        'ऍ' => 'ei',
        'ऎ' => 'ae',
        'ऑ' => 'oi',
        'ऒ' => 'oii',
        'अं' => 'an',
        'अः' => 'aha',
        '्' => '',
          'ं' => 'n',
            'ः' => 'h',
        'ा' => 'a',
        'ि' => 'i',
        'ी' => 'ee',
        'ू' => 'oo',
        'ु' => 'u',
        'े' => 'e',
        'ै' => 'ai',
        'ौ' => 'au',
        'ो' => 'o',

//ka character hindi
        'क' => 'Ka',
          'क्' => 'K',
            'का' => 'Kaa',
              'कि' => 'Ki',
                'कू' => 'koo',
                  'कु' => 'Ku',
                    'की' => 'Kee',
                      'के' => 'Ke',
                        'कै' => 'Kai',
                          'को' => 'Ko',
                            'कौ' => 'Kau',
                              'कं' => 'Kan',
                                'कः' => 'Kah',
//kha character hindi
        'ख' => 'Kha',
          'ख्' => 'kh',
            'खा' => 'Khaa',
              'खि' => 'Khi',
                'खी' => 'Khee',
                  'खु' => 'Khu',
                    'खू' => 'Khoo',
                      'खे' => 'Khe',
                        'खै' => 'Khai',
                          'खो' => 'Kho',
                            'खौ' => 'Khau',
                              'खं' => 'Khan',
                                'खः' => 'khah',

        'ग' => 'Ga',
          'ग्' => 'G',
            'गा' => 'Gaa',
              'गि' => 'Gi',
                'गी' => 'Gee',
                  'गु' => 'Gu',
                    'गू' => 'Goo',
                      'गे' => 'Ge',
                        'गै' => 'Gai',
                          'गो' => 'Go',
                            'गौ' => 'Gau',
                              'गं' => 'Gan',
                                'गः' => 'Gah',
        'घ' => 'Gha',
          'घ्' => 'Gh',
            'घा' => 'Ghaa',
              'घि' => 'Ghi',
                'घी' => 'Ghee',
                  'घु' => 'Ghu',
                    'घू' => 'Ghoo',
                      'घे' => 'Ghe',
                        'घै' => 'Ghai',
                          'घो' => 'Gho',
                            'घौ' => 'Ghau',
                              'घं' => 'Ghan',
                                'घः' => 'Ghah',
  //ch character in hindi
        'च' => 'Cha',
          'चा' => 'chaa',
            'च्' => 'ch',
              'चि' => 'chi',
                'ची' => 'chee',
                  'चु' => 'chu',
                    'चू' => 'choo',
                      'चे' => 'che',
                        'चै' => 'chai',
                          'चो' => 'cho',
                            'चौ' => 'chau',
                              'चौ' => 'chau',
                                'चौ' => 'chau',
                                  'चं' => 'chau',
                                    'चः' => 'cha',

        'छ' => 'Chha',
          'छा' => 'Chhaa',
            'छि' => 'Chhi',
              'छी' => 'Chhee',
                'छु' => 'Chhu',
                  'छू' => 'Chhoo',
                    'छे' => 'Chhe',
                      'छै' => 'Chhai',
                        'छो' => 'Chho',
                          'छौ' => 'Chhau',
                            'छं' => 'Chhan',
                              'छः' => 'Chhah',
                                'छ्' => 'Chh',
  //ja  hindi character
        'ज' => 'Ja',
          'ज्' => 'J',
            'जा' => 'Jaa',
              'जि' => 'Ji',
                'जी' => 'Jee',
                  'जु' => 'Ju',
                    'जू' => 'Joo',
                      'जे' => 'Je',
                        'जै' => 'Jai',
                          'जो' => 'Jo',
                            'जौ' => 'Jau',
                              'जं' => 'Jan',
                                'जः' => 'Jah',
  //झ  hindi character
        'झ' => 'Jha',
          'झा' => 'Jhaa',
            'झ्' => 'Jh',
              'झि' => 'Jhi',
                'झी' => 'Jhee',
                  'झु' => 'Jhu',
                    'झू' => 'Jhoo',
                      'झे' => 'Jhe',
                        'झै' => 'Jhai',
                         'झो' => 'Jho',
                          'झौ' => 'Jhau',
                            'झं' => 'Jhan',
                              'झः' => 'Jhah',

        'ट' => 'Ta',
          'टा' => 'Taa',
            'ट्' => 'T',
              'टि' => 'Ti',
                'टी' => 'Tee',
                  'टु' => 'Tu',
                    'टू' => 'Too',
                      'टे' => 'Te',
                        'टै' => 'Tai',
                          'टं' => 'Tan',
                            'टः' => 'Tah',
                              'टो' => 'To',
                                'टौ' => 'Tau',

        'ठ' => 'Tha',
          'ठ्' => 'Th',
            'ठा' => 'Thaa',
              'ठि' => 'Thi',
                'ठी' => 'Thee',
                  'ठु' => 'Thu',
                    'ठू' => 'Thoo',
                      'ठे' => 'The',
                        'ठै' => 'Thai',
                          'ठो' => 'Tho',
                            'ठौ' => 'Thau',
                              'ठं' => 'Than',
                                'ठः' => 'Thah',

        'ड' => 'Da',
          'ड्' => 'D',
            'डा' => 'Daa',
              'डि' => 'Di',
                'डी' => 'Dee',
                  'डु' => 'Du',
                    'डू' => 'Doo',
                      'डे' => 'De',
                        'डै' => 'Dai',
                          'डो' => 'Do',
                            'डौ' => 'Dau',
                              'डं' => 'Dan',
                                'डः' => 'Dah',
        'ढ' => 'Dha',
          'ढ्' => 'Dh',
            'ढा' => 'Dhaa',
              'ढि' => 'Dhi',
                'ढी' => 'Dhee',
                  'ढु' => 'Dhu',
                    'ढू' => 'Dhoo',
                      'ढे' => 'Dhe',
                        'ढै' => 'Dhai',
                          'ढो' => 'Dho',
                            'ढौ' => 'Dhau',
                              'ढं' => 'Dhan',
                                'ढः' => 'Dhah',

        'त' => 'Ta',
          'त्' => 'T',
            'ता' => 'Taa',
              'ती' => 'Tee',
                'ति' => 'Ti',
                  'तु' => 'Tu',
                    'तू' => 'Too',
                      'ते' => 'Te',
                        'तै' => 'Tai',
                          'तो' => 'To',
                            'तौ' => 'Tau',
                              'तं' => 'Tan',
                                'तः' => 'Tah',

        'थ' => 'Tha',
          'थ्' => 'Th',
            'था' => 'Thaa',
              'थि' => 'Thi',
                'थी' => 'Thee',
                  'थु' => 'Thu',
                    'थू' => 'Thoo',
                      'थे' => 'The',
                        'थै' => 'Thai',
                          'थो' => 'Tho',
                            'थौ' => 'Thau',
                              'थं' => 'Than',
                                'थः' => 'Thah',

        'द' => 'Da',
          'द्' => 'd',
            'दा' => 'Daa',
              'दि' => 'Di',
                'दी' => 'Dee',
                  'दु' => 'Du',
                    'दू' => 'Doo',
                      'दे' => 'De',
                        'दै' => 'Dai',
                          'दो' => 'Do',
                            'दौ' => 'Dau',
                              'दं' => 'Dan',
                                'दः' => 'Dah',

        'ध' => 'Dha',
          'ध्' => 'Dh',
            'धा' => 'Dhaa',
              'धि' => 'Dhi',
                'धी' => 'Dhee',
                  'धु' => 'Dhu',
                    'धू' => 'Dhoo',
                      'धे' => 'Dhe',
                        'धै' => 'Dhai',
                          'धो' => 'Dho',
                            'धौ' => 'Dhau',
                              'धं' => 'Dhan',
                                'धः' => 'Dhah',


        'न' => 'Na',
          'न्' => 'Na',
            'ना' => 'Naa',
              'नि' => 'Ni',
                'नी' => 'Nee',
                  'नु' => 'Nu',
                    'नू' => 'Noo',
                      'ने' => 'Ne',
                        'नै' => 'Nai',
                          'नो' => 'No',
                            'नौ' => 'Nau',
                              'नं' => 'Nan',
                                'नः' => 'Nah',

        'प' => 'Pa',
          'प्' => 'P',
            'पा' => 'Paa',
              'पि' => 'Pi',
                'पी' => 'Pee',
                  'पु' => 'Pu',
                    'पू' => 'Poo',
                      'पे' => 'Pe',
                        'पै' => 'Pai',
                          'पो' => 'Po',
                            'पौ' => 'Pau',
                              'पं' => 'Pan',
                                'पः' => 'Pah',


        'फ' => 'Fa',
          'फ्' => 'F',
            'फा' => 'Faa',
              'फी' => 'Fee',
                'फि' => 'Fi',
                  'फु' => 'Fu',
                    'फू' => 'Foo',
                      'फे' => 'Fe',
                        'फै' => 'Fai',
                          'फो' => 'Fo',
                            'फौ' => 'Fau',
                              'फं' => 'Fan',
                                'फः' => 'Fah',


        'ब' => 'Ba',
          'ब्' => 'B',
            'बा' => 'Baa',
              'बि' => 'Bi',
                'बी' => 'Bee',
                  'बु' => 'Bu',
                    'बू' => 'Boo',
                      'बे' => 'Be',
                        'बै' => 'Bai',
                          'बो' => 'Bo',
                            'बौ' => 'Bau',
                              'बं' => 'Ban',
                                'बः' => 'Bah',
        'भ' => 'Bha',
          'भ्' => 'Bh',
            'भा' => 'Bhaa',
              'भि' => 'Bhi',
                'भी' => 'Bhee',
                  'भु' => 'Bhu',
                    'भू' => 'Bhoo',
                      'भे' => 'Bhe',
                        'भै' => 'Bhai',
                          'भो' => 'Bho',
                            'भौ' => 'Bhau',
                              'भं' => 'Bhan',
                                'भः' => 'Bhah',
        'म' => 'Ma',
          'म्' => 'M',
            'मा' => 'Maa',
              'मि' => 'Mi',
                'मी' => 'Mee',
                  'मु' => 'Mu',
                    'मू' => 'Moo',
                      'मे' => 'Me',
                        'मै' => 'Mai',
                          'मो' => 'Mo',
                            'मौ' => 'Mau',
                              'मं' => 'Man',
                                'मः' => 'Mah',


        'य' => 'Ya',
          'य्' => 'Y',
            'या' => 'Yaa',
              'यि' => 'Yi',
                'यी' => 'Yee',
                  'यु' => 'Yu',
                    'यू' => 'Yoo',
                      'ये' => 'Ye',
                        'यै' => 'Yai',
                          'यो' => 'Yo',
                            'यौ' => 'Yau',
                              'यं' => 'Yan',
                                'यः' => 'Yah',


        'र' => 'Ra',
          'र्' => 'R',
            'रा' => 'Raa',
              'रि' => 'Ri',
                'री' => 'Ree',
                  'रु' => 'Ru',
                    'रू' => 'Roo',
                      'रे' => 'Re',
                        'रै' => 'Rai',
                          'रो' => 'Ro',
                            'रौ' => 'Rau',
                              'रं' => 'Ran',
                                'रः' => 'Rah',

        'ल' => 'La',
          'ल्' => 'L',
            'ला' => 'Laa',
              'लि' => 'Li',
                'ली' => 'Lee',
                  'लु' => 'Lu',
                    'लू' => 'Loo',
                      'ले' => 'Le',
                        'लै' => 'Lai',
                          'लो' => 'Lo',
                            'लौ' => 'Lau',
                              'लं' => 'Lan',
                                'लः' => 'Lah',

        'व' => 'Va',
          'व्' => 'V',
            'वा' => 'Vaa',
              'वि' => 'Vi',
                'वी' => 'Vee',
                  'वु' => 'Vu',
                    'वू' => 'Voo',
                      'वे' => 'Ve',
                        'वै' => 'Vai',
                          'वो' => 'Vo',
                            'वौ' => 'Vau',
                              'वं' => 'Van',
                                'वः' => 'Vah',

        'स' => 'Sa',
          'स्' => 'S',
            'सा' => 'Saa',
              'सि' => 'Si',
                'सी' => 'See',
                  'सु' => 'Su',
                    'सू' => 'Soo',
                      'से' => 'Se',
                        'सै' => 'Sai',
                          'सो' => 'So',
                            'सौ' => 'Sau',
                              'सं' => 'San',
                                'सः' => 'Sah',
        'श' => 'Sha',
          'श्' => 'Sh',
            'शा' => 'Shaa',
              'शि' => 'Shi',
                'शी' => 'Shee',
                  'शु' => 'Shu',
                    'शू' => 'Shoo',
                      'शे' => 'She',
                        'शै' => 'Shai',
                          'शो' => 'Sho',
                            'शौ' => 'Shau',
                              'शं' => 'Shan',
                                'शः' => 'Shah',

        'ष' => 'Shha',
          'ष्' => 'Shh',
            'षा' => 'Shhaa',
              'षि' => 'Shhi',
                'षी' => 'Shhee',
                  'षु' => 'Shhu',
                    'षू' => 'Shhoo',
                      'षे' => 'Shhe',
                        'षै' => 'Shhai',
                          'षो' => 'Shho',
                            'षौ' => 'Shhau',
                              'षं' => 'Shhan',
                                'षः' => 'Shhah',
        'ह' => 'Ha',
          'ह्' => 'H',
            'हा' => 'Haa',
              'हि' => 'Hi',
                'ही' => 'Hee',
                  'हु' => 'Hu',
                    'हू' => 'Hoo',
                      'हे' => 'He',
                        'है' => 'Hai',
                          'हो' => 'Ho',
                            'हौ' => 'Hau',
                              'हं' => 'Han',
                                'हः' => 'Hah',
        'क्ष' => 'Ksha',
        'त्र' => 'Tra',
        'ज्ञ' => 'Gya',
        'ळ' => 'Li',
        'ऌ' => 'Li',
        'ऴ' => 'Lii',
        'ॡ' => 'Lii',
        'ङ' => 'Na',
        'ञ' => 'Nia',
        'ण' => 'Nae',
        'ऩ' => 'Ni',
        'ॐ' => 'oms',
        'क़' => 'Qi',
        'ऋ' => 'Ri',
        'ॠ' => 'Ri',
        'ऱ' => 'Ri',
        'ड़' => 'ugDha',
        'ढ़' => 'ugDhha',
        'य़' => 'Yi',
        'ज़' => 'Za',
        'फ़' => 'Fi',
        'ग़' => 'Ghi'
    );
  }
}
