<?php
require('fpdf.php');

class PDF_HTML extends FPDF {
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';
		function conv($string) {
			return iconv('UTF-8', 'TIS-620', $string);
		}

		function SetThaiFont() {
			$this->AddFont('AngsanaNew','','angsa.php');
			$this->AddFont('AngsanaNew','B','angsab.php');
			$this->AddFont('AngsanaNew','I','angsai.php');
			$this->AddFont('AngsanaNew','IB','angsaz.php');
			$this->AddFont('CordiaNew','','cordia.php');
			$this->AddFont('CordiaNew','B','cordiab.php');
			$this->AddFont('CordiaNew','I','cordiai.php');
			$this->AddFont('CordiaNew','IB','cordiaz.php');
			$this->AddFont('Tahoma','','tahoma.php');
			$this->AddFont('Tahoma','B','tahomab.php');
			$this->AddFont('BrowalliaNew','','browa.php');
			$this->AddFont('BrowalliaNew','B','browab.php');
			$this->AddFont('BrowalliaNew','I','browai.php');
			$this->AddFont('BrowalliaNew','IB','browaz.php');
			$this->AddFont('KoHmu','','kohmu.php');
			$this->AddFont('KoHmu2','','kohmu2.php');
			$this->AddFont('KoHmu3','','kohmu3.php');
			$this->AddFont('MicrosoftSansSerif','','micross.php');
			$this->AddFont('PLE_Cara','','plecara.php');
			$this->AddFont('PLE_Care','','plecare.php');
			$this->AddFont('PLE_Care','B','plecareb.php');
			$this->AddFont('PLE_Joy','','plejoy.php');
			$this->AddFont('PLE_Tom','','pletom.php');
			$this->AddFont('PLE_Tom','B','pletomb.php');
			$this->AddFont('PLE_TomOutline','','pletomo.php');
			$this->AddFont('PLE_TomWide','','pletomw.php');
			$this->AddFont('DilleniaUPC','','dill.php');
			$this->AddFont('DilleniaUPC','B','dillb.php');
			$this->AddFont('DilleniaUPC','I','dilli.php');
			$this->AddFont('DilleniaUPC','IB','dillz.php');
			$this->AddFont('EucrosiaUPC','','eucro.php');
			$this->AddFont('EucrosiaUPC','B','eucrob.php');
			$this->AddFont('EucrosiaUPC','I','eucroi.php');
			$this->AddFont('EucrosiaUPC','IB','eucroz.php');
			$this->AddFont('FreesiaUPC','','free.php');
			$this->AddFont('FreesiaUPC','B','freeb.php');
			$this->AddFont('FreesiaUPC','I','freei.php');
			$this->AddFont('FreesiaUPC','IB','freez.php');
			$this->AddFont('IrisUPC','','iris.php');
			$this->AddFont('IrisUPC','B','irisb.php');
			$this->AddFont('IrisUPC','I','irisi.php');
			$this->AddFont('IrisUPC','IB','irisz.php');
			$this->AddFont('JasmineUPC','','jasm.php');
			$this->AddFont('JasmineUPC','B','jasmb.php');
			$this->AddFont('JasmineUPC','I','jasmi.php');
			$this->AddFont('JasmineUPC','IB','jasmz.php');
			$this->AddFont('KodchiangUPC','','kodc.php');
			$this->AddFont('KodchiangUPC','B','kodc.php');
			$this->AddFont('KodchiangUPC','I','kodci.php');
			$this->AddFont('KodchiangUPC','IB','kodcz.php');
			$this->AddFont('LilyUPC','','lily.php');
			$this->AddFont('LilyUPC','B','lilyb.php');
			$this->AddFont('LilyUPC','I','lilyi.php');
			$this->AddFont('LilyUPC','IB','lilyz.php');
			$this->AddFont('THSarabunNew','','THSarabunNew.php');
			$this->AddFont('THSarabunNew','B','THSarabunNew_b.php');
			$this->AddFont('THSarabunNew','I','THSarabunNew_i.php');
			$this->AddFont('THSarabunNew','IB','THSarabunNew_bi.php');
		}

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(6.5);
        if($tag=='P'){
            $this->ALIGN=$prop['ALIGN'];
            $this->Ln(2);
        }
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
}

// $pdf = new PDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial', 'B', 16);
// $pdf->Cell(40, 10, "Hello World ❏");
//
// $pdf->SetThaiFont();
//
// $pdf->SetFont('THSarabunNew', 'IBU', 16);
// $txt = $pdf->conv("สวัสดีชาวโลก");
// $pdf->cell(10, 20, $txt);
//
// $pdf->AddPage();
// $pdf->SetFont('THSarabunNew', 'B', 16);
// $txt = $pdf->conv("สวัสดีชาวโลก");
// $pdf->cell(20, 30, $txt);
// $pdf->Ln(20);

// $pdf->SetFont('THSarabunNew', 'I', 16);
// $txt = $pdf->conv("สวัสดีชาวโลก");
// $pdf->cell(30, 40, $txt);
// $pdf->SetFont('Arial');
// $str = iconv('UTF-8', 'windows-1252', html_entity_decode("&Omicron;"));
// $str = mb_convert_encoding("&Omicron;", 'UTF-8', 'HTML-ENTITIES');
// $pdf->cell(35, 40, $str);

// $pdf->SetFont('THSarabunNew', 'IB', 16);
// $txt = $pdf->conv("สวัสดีชาวโลก");
// $special = $pdf->special_conv(" ❏");
// $pdf->cell(40, 50, $txt . $special);
// $pdf->Output();
// echo $row['titleTH'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id=$_GET['id'];
$save=$_GET['save'];
$sql = "select * from scholarship_book where id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc())  {
    $year=$row['year'];
    $titleTH=$row['titleTH'];
    $titleEN=$row['titleEN'];
    $writer_name=$row['writer_name'];
    $writer_department=$row['writer_department'];
    $write_ratio=$row['write_ratio'];
    $co_writer_name=$row['co_writer_name'];
    $co_writer_department=$row['co_writer_department'];
    $co_write_ratio=$row['co_write_ratio'];
    $keywordTH=$row['keywordTH'];
    $keywordEN=$row['keywordEN'];
    $amount=$row['amount'];
    $amount_text=$row['amount_text'];
    $subject_no=$row['subject_no'];
    $subject=$row['subject'];
    $for_student=$row['for_student'];
    $student_year=$row['student_year'];
    $page_amount=$row['page_amount'];
    $chapter_no_1=$row['chapter_no_1'];
    $chapter_no_2=$row['chapter_no_2'];
    $chapter_no_3=$row['chapter_no_3'];
    $chapter_name_1=$row['chapter_name_1'];
    $chapter_name_2=$row['chapter_name_2'];
    $chapter_name_3=$row['chapter_name_3'];
    $content_1=$row['content_1'];
    $content_2=$row['content_2'];
    $content_3=$row['content_3'];
    $teaching_history=$row['teaching_history'];
    $applicant=$row['applicant'];
    $head_of_department=$row['head_of_department'];
    $department_name=$row['department_name'];
    $id=$row['id'];
  }
}

$npdf=new PDF_HTML();
$npdf->AddPage();
$npdf->SetThaiFont();
$npdf->SetFont('THSarabunNew', '', '15');
$year=$npdf->conv($year);
$titleTH=$npdf->conv($titleTH);
$titleEN=$npdf->conv($titleEN);
$writer_name=$npdf->conv($writer_name);
$writer_department=$npdf->conv($writer_department);
$write_ratio=$npdf->conv($write_ratio);
$co_writer_name=$npdf->conv($co_writer_name);
$co_writer_department=$npdf->conv($co_writer_department);
$co_write_ratio=$npdf->conv($co_write_ratio);
$keywordTH=$npdf->conv($keywordTH);
$keywordEN=$npdf->conv($keywordEN);
$amount=$npdf->conv($amount);
$amount_text=$npdf->conv($amount_text);
$subject_no=$npdf->conv($subject_no);
$subject=$npdf->conv($subject);
$for_student=$npdf->conv($for_student);
$student_year=$npdf->conv($student_year);
$page_amount=$npdf->conv($page_amount);
$chapter_no_1=$npdf->conv($chapter_no_1);
$chapter_no_2=$npdf->conv($chapter_no_2);
$chapter_no_3=$npdf->conv($chapter_no_3);
$chapter_name_1=$npdf->conv($chapter_name_1);
$chapter_name_2=$npdf->conv($chapter_name_2);
$chapter_name_3=$npdf->conv($chapter_name_3);
$content_1=$npdf->conv($content_1);
$content_2=$npdf->conv($content_2);
$content_3=$npdf->conv($content_3);
$teaching_history=$npdf->conv($teaching_history);
$applicant=$npdf->conv($applicant);
$head_of_department=$npdf->conv($head_of_department);
$department_name=$npdf->conv($department_name);

$header1=$npdf->conv('ข้อเสนอโครงการ');
$header2=$npdf->conv('ทุนสนับสนุนการเขียนตำราจากกองทุนสนับสนุนการวิจัย');
$header3=$npdf->conv('นวัตกรรมและการสร้างสรรค์ คณะวิทยาศาสตร์');
$header4=$npdf->conv("ประจำปีงบประมาณ ");

$npdf->SetFont('THSarabunNew', '', '16');
$npdf->WriteHTML("
<br>
<b><p align='center'>$header1</p></b>
<b><p align='center'>$header2</p></b>
<b><p align='center'>$header3</p></b>
<b><p align='center'>$header4..........$year..........</p></b>
<br>
");

$npdf->SetFont('THSarabunNew', '', '15');
$section1=$npdf->conv('     1. ชื่อตำรา');
$npdf->WriteHTML("<b>$section1<b><br>");

$npdf->SetFont('THSarabunNew', '', '15');
$section1_1=$npdf->conv("    (ไทย)");
$section1_2=$npdf->conv("    (English)");
$npdf->SetXY(17,57);
$npdf->write(6.5,"$section1_1");
$npdf->SetXY(32,56);
$npdf->write(6.5,"$titleTH");
$npdf->SetXY(30,57);
$npdf->write(6.5,"..........................................................................................................................................................................................");
$npdf->SetXY(22,64);
$npdf->write(6.5,"...................................................................................................................................................................................................");
$npdf->SetXY(17,71);
$npdf->write(6.5,"$section1_2");
$npdf->SetXY(37,70);
$npdf->write(6.5,"$titleEN");
$npdf->SetXY(35,71);
$npdf->write(6.5,"....................................................................................................................................................................................");
$npdf->SetXY(22,78);
$npdf->write(6.5,"...................................................................................................................................................................................................");

$npdf->SetFont('THSarabunNew', '', '15');
$section2=$npdf->conv('2. ชื่อผู้เขียน หรือคณะผู้เขียน');
$npdf->WriteHTML("<br><br><b>      $section2<b>");

$npdf->SetFont('THSarabunNew', '', '15');
$section2_1=$npdf->conv('    หัวหน้าโครงการ          ชื่อ-สกุล');
$section2_2=$npdf->conv('ภาควิชา');
$section2_3=$npdf->conv('สัดส่วนของการเขียนตำรา');
$section2_4=$npdf->conv('เปอร์เซ็นต์');
$section2_5=$npdf->conv('    ผู้ร่วมโครงการ            ชื่อ-สกุล');
$section2_6=$npdf->conv('ภาควิชา');
$section2_7=$npdf->conv('สัดส่วนของการเขียนตำรา');
$section2_8=$npdf->conv('เปอร์เซ็นต์');
$npdf->SetXY(17,97);
$npdf->write(6.5,"$section2_1");
$npdf->SetXY(70,96);
$npdf->write(6.5,"$writer_name");
$npdf->SetXY(69,97);
$npdf->write(6.5,".............................................................................................................................................");
$npdf->SetXY(55,104);
$npdf->write(6.5,"$section2_2");
$npdf->SetXY(70,103);
$npdf->write(6.5,"$writer_department");
$npdf->SetXY(69,104);
$npdf->write(6.5,".............................................................................................................................................");
$npdf->SetXY(55,111);
$npdf->write(6.5,"$section2_3");
$npdf->SetXY(95,110);
$npdf->write(6.5,"$write_ratio");
$npdf->SetXY(93,111);
$npdf->write(6.5,"...........");
$npdf->SetXY(105,111);
$npdf->write(6.5,"$section2_4");

$npdf->SetXY(17,118);
$npdf->write(6.5,"$section2_5");
$npdf->SetXY(70,117);
$npdf->write(6.5,"$co_writer_name");
$npdf->SetXY(69,118);
$npdf->write(6.5,".............................................................................................................................................");
$npdf->SetXY(55,125);
$npdf->write(6.5,"$section2_6");
$npdf->SetXY(70,124);
$npdf->write(6.5,"$co_writer_department");
$npdf->SetXY(69,125);
$npdf->write(6.5,".............................................................................................................................................");
$npdf->SetXY(55,132);
$npdf->write(6.5,"$section2_7");
$npdf->SetXY(95,131);
$npdf->write(6.5,"$co_write_ratio");
$npdf->SetXY(93,132);
$npdf->write(6.5,"...........");
$npdf->SetXY(105,132);
$npdf->write(6.5,"$section2_8");

$npdf->SetFont('THSarabunNew', '', '15');
$section3=$npdf->conv('3. คำสำคัญ');
$npdf->WriteHTML("<br><br><b>      $section3<b>");

$npdf->SetFont('THSarabunNew', '', '15');
$section3_1=$npdf->conv("    (ไทย)");
$section3_2=$npdf->conv("    (English)");

$npdf->SetXY(17,152);
$npdf->write(6.5,"$section3_1");
$npdf->SetXY(32,151);
$npdf->write(6.5,"$keywordTH");
$npdf->SetXY(30,152);
$npdf->write(6.5,"..........................................................................................................................................................................................");
$npdf->SetXY(17,159);
$npdf->write(6.5,"$section3_2");
$npdf->SetXY(37,158);
$npdf->write(6.5,"$keywordEN");
$npdf->SetXY(35,159);
$npdf->write(6.5,"....................................................................................................................................................................................");

$npdf->SetFont('THSarabunNew', '', '15');
$section4=$npdf->conv('4. จำนวนเงินทุนที่ขอรับการสนับสนุน');
$npdf->WriteHTML("<br><br><b>      $section4<b>");

$npdf->SetFont('THSarabunNew', '', '15');
$section4_1=$npdf->conv('จำนวน');
$section4_2=$npdf->conv('บาท');
$section4_3=$npdf->conv('บาทถ้วน');
$npdf->SetXY(22,179);
$npdf->write(6.5,"$section4_1");
$npdf->SetXY(45,178);
$npdf->write(6.5,"$amount");
$npdf->SetXY(33,179);
$npdf->write(6.5,"........................................");
$npdf->SetXY(68,179);
$npdf->write(6.5,"$section4_2");
$npdf->SetXY(80,178);
$npdf->write(6.5,"$amount_text");
$npdf->SetXY(75,179);
$npdf->write(6.5,"(......................................");
$npdf->SetXY(109,179);
$npdf->write(6.5,"$section4_3)");

$section4_5=$npdf->conv('   * จำนวนเงินทุนพิจารณาสนับสนุนทางด้านวิชาการและสนับสนุนด้านการพิมพ์เอกสาร ดังนี้');
$section4_6=$npdf->conv('    ส่วนที่ 1 ด้านวิชาการ');
$section4_7=$npdf->conv('            -    ตำราประกอบการสอนรายวิชาชั้นปีที่ 1 และ 2         สนับสนุนเงินทุน 20,000 บาท');
$section4_8=$npdf->conv('            -    ตำราประกอบการสอนรายวิชาชั้นปีที่ 3 และ 4         สนับสนุนเงินทุน 30,000 บาท');
$section4_9=$npdf->conv('            -    ตำราประกอบการสอนรายวิชาระดับบัณฑิตศึกษา      สนับสนุนเงินทุน 40,000 บาท');
$section4_10=$npdf->conv('    ส่วนที่ 2 ด้านการพิมพ์เอกสาร');
$section4_11=$npdf->conv('           คำนวณจากปริมาณเนื้อหา (จำนวนหน้า) หน้าละ 100 บาท');
$section4_12=$npdf->conv('    โดยข้อเสนอโครงการเขียนตำราทุกโครงการจะได้รับการจัดสรรเงินทุนสนับสนุนการเขียนตำราทั้ง 2 ส่วน แต่รวมแล้ว');
$section4_13=$npdf->conv('    ต้องไม่เกิน 50,000 บาท');
$section4_14=$npdf->conv('    * ในกรณีที่เป็นตำราในรายวิชาปฏิบัติการให้การสนับสนัุนเป็นกึ่งหนึ่งตามหลักเกณฑ์ข้างต้น');

$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetTextColor(255,0,0);
$npdf->WriteHTML("
<br><br>       $section4_5<br>
<b>       $section4_6</b><br>
");
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetTextColor(255,0,0);
$npdf->WriteHTML("       $section4_7<br>
       $section4_8<br>
       $section4_9<br>
");
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetTextColor(255,0,0);
$npdf->WriteHTML("
<b>      $section4_10</b><br>
");
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetTextColor(255,0,0);
$npdf->WriteHTML("
       $section4_11<br>
       $section4_12<br>
       $section4_13<br>
       $section4_14<br>
");

$section5=$npdf->conv('5. ใช้ประกอบการสอน');
$section5_1=$npdf->conv('     รายวิชา');
$section5_2=$npdf->conv('ชื่อวิชา');
$section5_3=$npdf->conv('สำหรับนักศึกษาระดับ');
$section5_4=$npdf->conv('ชั้นปีที่');

$npdf->SetTextColor(0,0,0);
$npdf->WriteHTML("
<b><br>    $section5</b><br>
");
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(13,269);
$npdf->write(6.5,"$section5_1");
$npdf->SetXY(38,268);
$npdf->write(6.5,"$subject_no");
$npdf->SetXY(30,269);
$npdf->write(6.5,"...........................");
$npdf->SetXY(54,269);
$npdf->write(6.5,"$section5_2");
$npdf->SetXY(80,268);
$npdf->write(6.5,"$subject");
$npdf->SetXY(64,269);
$npdf->write(6.5,".........................................................................");
$npdf->SetXY(127,269);
$npdf->write(6.5,"$section5_3");
$npdf->SetXY(160,268);
$npdf->write(6.5,"$for_student");
$npdf->SetXY(158,269);
$npdf->write(6.5,"....................");
$npdf->SetXY(176,269);
$npdf->write(6.5,"$section5_4");
$npdf->SetXY(187,268);
$npdf->write(6.5,"$student_year");
$npdf->SetXY(185,269);
$npdf->write(6.5,"............");

$section6=$npdf->conv('6. ปริมาณเนื้อหาและเนื้อหาโดยสังเขป');
$section6_1=$npdf->conv('ปริมาณเนื้อหา (จำนวนหน้า) โดยประมาณ จำนวน');
$section6_2=$npdf->conv('หน้า  โดยประกอบด้วยเนื้อหาโดยสังเขป ดังนี้');
$section6_3=$npdf->conv('บทที่');
$section6_4=$npdf->conv('ชื่อบท');
$npdf->WriteHTML("<b>      $section6</b><br>");
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(18,17);
$npdf->write(6.5,"$section6_1");
$npdf->SetXY(90,16);
$npdf->write(6.5,"$page_amount");
$npdf->SetXY(88,17);
$npdf->write(6.5,"............");
$npdf->SetXY(100,17);
$npdf->write(6.5,"$section6_2");
//1
$npdf->SetXY(18,24);
$npdf->write(6.5,"$section6_3");
$npdf->SetXY(26,24);
$npdf->write(6.5,"............");
$npdf->SetXY(27,23);
$npdf->write(6.5,"$chapter_no_1");
$npdf->SetXY(37,24);
$npdf->write(6.5,"$section6_4");
$npdf->SetXY(47,24);
$npdf->write(6.5,"...................................................");
$npdf->SetXY(49,23);
$npdf->write(6.5,"$chapter_name_1");

$section6_5=$npdf->conv('*เนื้อหา');
$npdf->SetTextColor(255,0,0);
$npdf->SetXY(26,31);
$npdf->write(6.5,"$section6_5");
$npdf->SetTextColor(0,0,0);
$npdf->SetXY(40,30);
$npdf->write(6.5,"$content_1");
$npdf->SetXY(37,31);
$npdf->write(6.5,"...................................................................................................................................................................................");
$npdf->SetXY(18,38);
$npdf->write(6.5,"..........................................................................................................................................................................................................");
$npdf->SetXY(18,45);
$npdf->write(6.5,"..........................................................................................................................................................................................................");
//2
$npdf->SetXY(18,60);
$npdf->write(6.5,"$section6_3");
$npdf->SetXY(26,60);
$npdf->write(6.5,"............");
$npdf->SetXY(27,59);
$npdf->write(6.5,"$chapter_no_2");
$npdf->SetXY(37,60);
$npdf->write(6.5,"$section6_4");
$npdf->SetXY(47,60);
$npdf->write(6.5,"...................................................");
$npdf->SetXY(49,59);
$npdf->write(6.5,"$chapter_name_2");

$section6_5=$npdf->conv('*เนื้อหา');
$npdf->SetTextColor(255,0,0);
$npdf->SetXY(26,67);
$npdf->write(6.5,"$section6_5");
$npdf->SetTextColor(0,0,0);
$npdf->SetXY(40,66);
$npdf->write(6.5,"$content_2");
$npdf->SetXY(37,67);
$npdf->write(6.5,"...................................................................................................................................................................................");
$npdf->SetXY(18,74);
$npdf->write(6.5,"..........................................................................................................................................................................................................");
$npdf->SetXY(18,82);
$npdf->write(6.5,"..........................................................................................................................................................................................................");
//3
$npdf->SetXY(18,98);
$npdf->write(6.5,"$section6_3");
$npdf->SetXY(26,98);
$npdf->write(6.5,"............");
$npdf->SetXY(27,97);
$npdf->write(6.5,"$chapter_no_2");
$npdf->SetXY(37,98);
$npdf->write(6.5,"$section6_4");
$npdf->SetXY(47,98);
$npdf->write(6.5,"...................................................");
$npdf->SetXY(49,97);
$npdf->write(6.5,"$chapter_name_2");

$section6_5=$npdf->conv('*เนื้อหา');
$npdf->SetTextColor(255,0,0);
$npdf->SetXY(26,105);
$npdf->write(6.5,"$section6_5");
$npdf->SetTextColor(0,0,0);
$npdf->SetXY(40,104);
$npdf->write(6.5,"$content_2");
$npdf->SetXY(37,105);
$npdf->write(6.5,"...................................................................................................................................................................................");
$npdf->SetXY(18,112);
$npdf->write(6.5,"..........................................................................................................................................................................................................");
$npdf->SetXY(18,119);
$npdf->write(6.5,"..........................................................................................................................................................................................................");

$section7=$npdf->conv('7. ประวัติการสอน');
$section7_1=$npdf->conv('(โดยสังเขป)');
$npdf->SetTextColor(0,0,0);
$npdf->WriteHTML("
<br><br><b>    $section7</b>
");
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->WriteHTML("$section7_1<br>");
$npdf->SetXY(22,138);
$npdf->write(6.5,"$teaching_history");
$npdf->SetXY(19,139);
$npdf->write(6.5,".........................................................................................................................................................................................................");
$npdf->SetXY(19,146);
$npdf->write(6.5,".........................................................................................................................................................................................................");
$npdf->SetXY(19,153);
$npdf->write(6.5,".........................................................................................................................................................................................................");

$section7_2=$npdf->conv('* หากมีอยู่แล้วสามารถแนบประวัติการสอนต่อท้ายข้อเสนอโครงการได้');
$npdf->SetTextColor(255,0,0);
$npdf->SetXY(19,159);
$npdf->write(6.5,"$section7_2");

$section8=$npdf->conv('ลงชื่อ');
$section8_1=$npdf->conv('ผู้ขอรับทุน');
$npdf->SetTextColor(0,0,0);
$npdf->SetXY(100,200);
$npdf->write(6.5,"$section8");
$npdf->SetXY(108,200);
$npdf->write(6.5,"........................................................");
$npdf->SetXY(110,206);
$npdf->write(6.5,"$applicant");
$npdf->SetXY(100,207);
$npdf->write(6.5,"(.................................................................)");
$npdf->SetXY(120,214);
$npdf->write(6.5,"$section8_1");

$section9=$npdf->conv('ลงชื่อ');
$section9_1=$npdf->conv('หัวหน้าภาควิชา');
$npdf->SetTextColor(0,0,0);
$npdf->SetXY(100,240);
$npdf->write(6.5,"$section9");
$npdf->SetXY(108,240);
$npdf->write(6.5,"........................................................");
$npdf->SetXY(110,246);
$npdf->write(6.5,"$head_of_department");
$npdf->SetXY(100,247);
$npdf->write(6.5,"(.................................................................)");
$npdf->SetXY(100,254);
$npdf->write(6.5,"$section9_1");
$npdf->SetXY(122,254);
$npdf->write(6.5,"..................................................");
$npdf->SetXY(125,253);
$npdf->write(6.5,"$department_name");
// $npdf->SetXY(115,270);
// $npdf->write(6.5,"2");

if(isset($_GET['save']) && $_GET['save']=='true'){
  $npdf->Output("./save_generate_pdf/book_$id.pdf",'F');
  echo "
  <!DOCTYPE html>
  <html lang='en'>
  <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='https://printjs-4de6.kxcdn.com/print.min.js'></script>
  </head>
  <body>
    <script>
      printJS('./seniorproject/report/save_generate_pdf/book_$id.pdf')
    </script>
  </body>
  </html>
  ";
}
else{
  $npdf->Output();
}

?>
