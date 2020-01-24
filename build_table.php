<?php  
function build_table($response){
    // membuat tabel
    $html = '<table>';
    // mengisi header tabel
    $html .= '<tr>';
    foreach($response[0] as $key=>$value){
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    $html .= '</tr>';

    for ($i=0; $i < sizeof($response); $i++) { 
        $html .= '<tr>';
        //menampilkan isi tid
        $html .= '<td>' . $response[$i]["tid"]  . '</td>';
        //menampilkan isi token
        $html .= '<td>' . $response[$i]["token"]  . '</td>';
        //menampilkan isi participant_info
        $html .= '<td>' . $response[$i]["participant_info"]["firstname"]  . '</td>';
        $html .= '</tr>';
    }
?>