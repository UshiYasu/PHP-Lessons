<?php 

//グー　チョキ　パーの定数
const STONE = "0";
const SCISSORS = "1";
const PAPER = "2";

const HAND_TYPE = array(
    STONE => "グー",
    SCISSORS => "チョキ",
    PAPER => "パー",
);

const LOSE = 0;
const WIN = 1;
const EVEN = 2;

const RESULT = array(
     LOSE => "あなたの負けです".PHP_EOL,
     WIN =>  "あなたの勝ちです".PHP_EOL,
     EVEN => "あいこです。もう一度入力してください".PHP_EOL,
);

//リトライ判定用の定数
const RETRY = "1";
const FINISH = "2";

//相手の手を入力させる
function getComHand(){
    $input = trim(fgets(STDIN));
    $flag = check($input);
    if ($flag === false){
        return getComHand();
    }
    return $input;
}
//入力が1,2,3でされているかの確認
function check($value){
    if ($value != STONE && $value != SCISSORS && $value != PAPER){
        echo "「".STONE."」「".SCISSORS."」「".PAPER."」のいずれかを入力してください".PHP_EOL;
        return false;
    }
    return true;

}
//自分の手を生成する
function getMyHand(){
    $myHand = rand(0,2);
    return $myHand;
}

//勝負を判定させる
function judge($comHand, $myHand){
    $result = ($comHand - $myHand + 2) % 3;
    return $result;
}
 
//結果を表示させる
function show ($myHand, $comHand, $result){
        echo "私は".HAND_TYPE[$myHand].PHP_EOL;
        echo RESULT[$result];
}

//もう一度じゃんけんをするか、プログラムを終わるかを聞く
function askRetry(){
    echo "もういちどじゃんけんをしたい場合は「".RETRY."」を、終了する場合は「".FINISH."」を入力してください".PHP_EOL;
    $input = trim(fgets(STDIN));
    $check = false;
    if ($input === RETRY){
        $check = true;
    }elseif ($input === FINISH){
        $check = false;
    }else{
        echo "「".RETRY."」または「".FINISH."」で入力してください".PHP_EOL;
        return askRetry();
    }
    return $check;
}

//一連の流れをbattle関数に入れ、あいこのとき、またもう一度対戦したいとき再帰させる
function battle(){
    echo "Gu-の場合は「".STONE."」を Chokiの場合は「".SCISSORS."」を Pa-の場合は「".PAPER."」を入力してください".PHP_EOL;
    $myHand = getMyHand();
    $comHand = getComHand();
    $result = judge($comHand, $myHand);
    show($myHand, $comHand ,$result);
    if ($result === EVEN){
        return battle();
    }
    $retry = askRetry();
    if ($retry === true){
        echo "もう一度じゃんけんをします".PHP_EOL;
        return battle();
    }
    if ($retry === false){
        echo "じゃんけんを終了します";
        exit();
    }


}

//実行
echo "じゃんけんをしましょう".PHP_EOL;
battle();
?>