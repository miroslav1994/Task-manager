<style>
    /* The switch - the box around the slider */
   .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 20px;
   }

   /* Hide default HTML checkbox */
   .switch input {
        opacity: 0;
        width: 0;
        height: 0;
   }

   /* The slider */
   .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
   }

   .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 0px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
   }

   input:checked + .slider {
         background-color: #2196F3;
   }

   input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
   }

   input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(42px);
   }
   /* Rounded sliders */
   .slider.round {
        border-radius: 34px;
   }
   
   .slider.round:before {
        border-radius: 50%
    }
    
    .round {
        height:20px !important;
    }
</style>

{{--     @foreach
 --}}
<?php

    
   /*  $razur = $_SESSION[P_DB_NAZIV]['id'];   
    $notifikacije = $pdo->query("select notifikacije "
            . "from podrska.zahtjevst "
            . "where zahtjev_id = $p_id "
            . "and razur = $razur "
            . "and notifikacije is not null");
    
    $broj_notifikacije = $notifikacije->rowCount();
    
    if($broj_notifikacije == 0) {
        $checked = "";
    } else {
        if($notifikacije->fetch()['notifikacije'] == 'NE') $checked = '';
        else $checked = "checked";
    } */
?>

<h4>
    <span>Isključi obavještenja</span>
    <label class="switch" style="float:right;">
        <input type="checkbox" id ="notifikacija_id" <?php /* echo $checked; */ ?> onclick="iskljuci_notifikacije(<?php/*  echo $p_id;  */?>)" style="height:20px !important;">
        <span class="slider round" style=></span>
    </label>
</h4>
