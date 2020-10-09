<form action="../report/generate_book_report.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="year">ปีงบประมาณ</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกปีงบประมาณ" name="year">
    </div>
    <div class="form-group">
      <label for="titleTH">ชื่อตำรา(ไทย)</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกชื่อตำรา(ไทย)" name="titleTH">
    </div>
    <div class="form-group">
      <label for="titleEN">ชื่อตำรา(english)</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกชื่อตำรา(english)" name="titleEN">
    </div>
    <div class="form-group">
      <label for="writer_name">ชื่อ-สกุลหัวหน้าโครงการ</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ-สกุลหัวหน้าโครงการ" name="writer_name">
    </div>
    <div class="form-group">
      <label for="writer_department">ภาควิชา</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกภาควิชา" name="writer_department">
    </div>
    <div class="form-group">
      <label for="write_ratio">สัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกสัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)" name="write_ratio">
    </div>
    <div class="form-group">
      <label for="co_writer_name">ชื่อ-สกุลผู้ร่วมโครงการ</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ-สกุลผู้ร่วมโครงการ" name="co_writer_name">
    </div>
    <div class="form-group">
      <label for="co_writer_department">ภาควิชา</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกภาควิชา" name="co_writer_department">
    </div>
    <div class="form-group">
      <label for="co_write_ratio">สัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)</label>
      <input type="text" class="form-control" placeholder="กรุณากรอกสัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)" name="co_write_ratio">
    </div>
    <div class="form-group">
      <label for="keywordTH">คำสำคัญ(ไทย)</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุคำสำคัญ(ไทย)" name="keywordTH">
    </div>
    <div class="form-group">
      <label for="keywordEN">คำสำคัญ(english)</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุคำสำคัญ(english)" name="keywordEN">
    </div>
    <div class="form-group">
      <label for="amount">จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นตัวเลข เช่น 2,000)</label>
      <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount">
    </div>
    <div class="form-group">
      <label for="amount_text">จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นข้อความ เช่น สองพัน)</label>
      <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount_text">
    </div>
    <div class="form-group">
      <label for="subject_no">รายวิชา</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุรายวิชา" name="subject_no">
    </div>
    <div class="form-group">
      <label for="subject">ชื่อวิชา</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุชื่อวิชา" name="subject">
    </div>
    <div class="form-group">
      <label for="for_student">สำหรับนักศึกษาระดับ(เช่น ปริญญาตรี)</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุระดับนักศึกษา" name="for_student">
    </div>
    <div class="form-group">
      <label for="student_year">ชั้นปีที่</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุชั้นปี" name="student_year">
    </div>
    <div class="form-group">
      <label for="page_amount">ปริมาณเนื้อหา(จำนวนหน้า)</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุจำนวนหน้า" name="page_amount">
    </div>
    <div class="form-group">
      <label for="chapter_no">บทที่</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุบทที่" name="chapter_no">
    </div>
    <div class="form-group">
      <label for="chapter_name">ชื่อบท</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุชื่อบท" name="chapter_name">
    </div>
    <div class="form-group">
      <label for="content">เนื้อหา</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุเนื้อหา" name="content">
    </div>
    <div class="form-group">
      <label for="teaching_history">ประวัติการสอน(โดยสังเขป)</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุประวัติการสอน(โดยสังเขป)" name="teaching_history">
    </div>
    <div class="form-group">
      <label for="applicant">ลงชื่อ(ผู้ขอรับทุน)</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุชื่อผู้ขอรับทุน" name="applicant">
    </div>
    <div class="form-group">
      <label for="Head of Department">ลงชื่อ(หัวหน้าภาควิชา)</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุชื่อหัวหน้าภาควิชา" name="head_of_department">
    </div>
    <div class="form-group">
      <label for="department_name">สังกัดของหัวหน้าภาควิชา(เช่น ภาควิชาคอมพิวเตอร์)</label>
      <input type="text" class="form-control" placeholder="กรุณาระบุสังกัดภาควิชา" name="department_name">
    </div>


    <button type="submit" class="btn btn-success">Done</button>
</form>
