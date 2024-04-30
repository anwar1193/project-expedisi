
<div id="modalReportUser" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><i data-feather="file-text"></i> Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="fs-15">
                    :: Report Data User ::
                </h6>
            </div>
            <div class="modal-footer">
                <a href="<?php echo e(route('users.export-pdf')); ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Export PDF">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>

                <a href="<?php echo e(route('users.export-excel')); ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Excel">
                    <i class="fa fa-file-excel-o"></i> Export Excel
                </a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modalReportSurveilance" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><i data-feather="file-text"></i> Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="fs-15">
                    :: Report Data Surveilance Car ::
                </h6>
            </div>
            <div class="modal-footer">
                <a href="<?php echo e(route('surveilance-car.export-pdf')); ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Export PDF">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>

                <a href="<?php echo e(route('surveilance-car.export-excel')); ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Excel">
                    <i class="fa fa-file-excel-o"></i> Export Excel
                </a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="modalReportPerangkat" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><i data-feather="file-text"></i> Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="fs-15">
                    :: Report Data Perangkat ::
                </h6>
            </div>
            <div class="modal-footer">
                <a href="<?php echo e(route('perangkat.export-pdf')); ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Export PDF">
                    <i class="fa fa-file-pdf-o"></i> Export PDF
                </a>

                <a href="<?php echo e(route('perangkat.export-excel')); ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Excel">
                    <i class="fa fa-file-excel-o"></i> Export Excel
                </a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/components/modal-sidebar.blade.php ENDPATH**/ ?>