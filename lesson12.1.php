<?php 

const STONE = 0;
const SCISSORS = 1;
const PAPER = 2;

const HAND_TYPE = array(
    STONE => "グー",
    SCISSORS => "チョキ",
    PAPER => "パー",
);

const RESULT = array(
     "あなたの負けです",
     "あなたの勝ちです",
     "あいこです。もう一度入力してください",
);


function getComHand(){
    $input = trim(fgets(STDIN));
    $flag = check($input);
    if ($flag === false){
        return input();
    }
    return $input;
}

function check($value){
    if ($value != 1 && $value != 2 && $value != 2){
        echo "「0」「1」「2」のいずれかを入力してください".PHP_EOL;
        return false;
    }
    return true;

}

function getMyHand(){
    $myHand = rand(0,2);
    return $myHand;
}


function judge($comHand, $myHand){
    $result = ($comHand - $myHand + 2) % 3;
    return $result;
}
 
function show ($myHand, $comHand, $result){
        echo "私は".HAND_TYPE[$myHand].PHP_EOL;
        echo RESULT[$result];
        if ($result === 2){
            return battle();
        }
}
//以上の関数をbattleという関数にいれ、あいこの際に最初から繰り返すようにする

function battle(){
    $myHand = getMyHand();
    $comHand = getComHand();
    $result = judge($comHand, $myHand);
    show($myHand, $comHand ,$result);
        }



//実行
echo "じゃんけんをしましょう　Gu-の場合は「0」を Chokiの場合は「1」を Pa-の場合は「2」を入力してください";
battle();
    



 ?>