<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
          <a data-toggle="modal" data-target="#myModal">
            <i class="fa fa-th"></i> <span>Import CSV</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->

  </aside>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import CSV</h4>
      </div>
      <div class="modal-body">
        <input id="iportCSV" type="file" name="xlfile" id="xlf">
      </div>
      <div class="modal-footer">
        <button id="submit" type="button" class="btn btn-default" >Import</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  @push('scripts')
    <script src="js/importcsv.js"></script>
    <script>
        var importCsv = new window.Controller.importCsv();
    </script>
  @endpush