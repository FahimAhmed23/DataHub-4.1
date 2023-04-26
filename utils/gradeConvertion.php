<?php
 function gradeConvertion($grade) {
    if($grade >= 86){
        return "'A'";
    }
    elseif($grade >= 85 && $grade <= 89){
        return "'A-'";
    } 
    elseif($grade >= 80 && $grade <= 84) {
        return "'B+'";
    } elseif ($grade >= 75 && $grade <= 79) {
        return "'B'";
    } elseif ($grade >= 70 && $grade <= 74) {
        return "'B-'";
    } elseif ($grade >= 65 && $grade <= 69) {
        return "'C+'";
    } elseif ($grade >= 60 && $grade <= 64) {
        return "'C'";
    } elseif ($grade >= 55 && $grade <= 59) {
        return "'C-'";
    } elseif ($grade >= 50 && $grade <= 54) {
        return "'D+'";
    } elseif ($grade >= 45 && $grade <= 49) {
        return "'D'";
    } elseif ($grade >= 0 && $grade <= 44) {
        return "'F'";
    }
 }
