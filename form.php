<form class="form-inline row" action="http://localhost/seniorproject/index.php" method="get">
  <div class="col-md-4">
    <select class="form-control" name="type">
        <option value="all">ทุกประเภท(All)</option>
        <option value="books">หนังสือ(Books)</option>
        <option value="journals">วารสารทางวิชาการ(Journals)</option>
        <option value="proceedings">เอกสารจากการประชุมวิชาการ(Proceedings)</option>
    </select>
  </div>
  <div class="col-md-6">
    <input class="form-control" type="text" placeholder="Search by title(TH), title(EN), author, year" name="search" style="width:100%">
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-dark"> <i class="fas fa-search"></i> ค้นหา</button>
  </div>
</form>
<hr>
