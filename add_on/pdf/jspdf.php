
<?php 
    class jspdf{

        static function pdfopen($function,$orientation,$measurement,$papersize){
            echo '<script src=" '.BASE_URL . 'resources/js/jspdf.debug.js"></script> 
            <script> var '. $function .'= function () {
            $(document).ready(function () {' . "var doc = new jsPDF('".$orientation."', '".$measurement."'," .$papersize .");";
        }

        static function defaultfonts($deffontfam,$deffontstyle,$deffontsize,$deftextcolor){
            echo 'doc.setFont("'.$deffontfam.'");';
            echo 'doc.setFontStyle("'.$deffontstyle.'");';
            echo 'doc.setFontSize("'.$deffontsize.'");';
            echo 'doc.setTextColor('.$deftextcolor.');';
        }

        static function fontfam($fam){
            echo 'doc.setFont("'.$deffontfam.'");';
        }

        static function fontstyle($style){
            echo 'doc.setFontStyle("'.$deffontstyle.'");';
        }

        static function fontsize($size){
            echo 'doc.setFontSize("'.$deffontsize.'");';
        }

        static function textcolor($color){
            echo 'doc.setTextColor('.$deftextcolor.');';
        }

        static function addtext($text,$top,$right,$bottom,$left,$position){
            echo "doc.text('".$text."', ".$top.", ".$right.", ".$bottom.", ".$left.", '".$position."');";
        }  
        
        static function LineWidth($width){
            echo 'doc.setLineWidth('.$width.');';
        }

        static function DrawColor($color){
            echo 'doc.setDrawColor('.$color.');';
        }

        static function LineDash($val){
            echo 'doc.setLineDash('.$val.')';
        }

        static function line($top,$right,$bottom,$left){
            echo 'doc.line('.$top.','.$right.','.$bottom.','.$left.')';
        }

        static function functionOpen($name){
            echo 'function '.$name.'() {';
        }

        static function functionClose(){
            echo '}';
        }

        static function callFunction($name){
            echo $name.'();';
        }

        static function addPage(){
            echo 'doc.addPage();';
        }

        static function pdfclose($title,$subject,$author,$keywords,$creator,$iframeid, $filename="jspdf"){
            echo "doc.setProperties({
                title: ' ".$title."',
                subject: '".$subject."',
                author: '".$author."',
                keywords: '".$keywords."',
                creator: '".$creator."'
            });"
            .
             "var string = doc.output('datauristring');
            $('#".$iframeid."').attr('src', string);"

            ."doc.save('".$filename."' + '.pdf');"
            
            . "});
            } </script>";
        }

        static function onload($function){
            echo '<script>
                window.onload = function () {
                    '.$function.'();
                };
            </script>';
        }

    }
?>
