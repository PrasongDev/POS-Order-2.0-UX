<input type="hidden" id="product_id"/>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block" id="_loadding">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <?php
                    if ($shop->type_shop_id == 1) {
                        ?>
                        <a href="<?php echo base_url() . 'product/addproduct'; ?>"  style="float: right" class="btn btn-sm btn-rounded btn-outline-success"><i class="fa fa-plus"></i> เพิ่มสินค้า</a>
                        <span style="float: right">&nbsp;</span>
                        <button  type="file" style="float: right;" class="btn btn-sm btn-rounded btn-outline-primary" onclick="import_modal();"><i class="fa fa-file-excel-o"></i> นำเข้าไฟล์ (CSV)</button>
                        <span style="float: right">&nbsp;</span>
                        <?php
                    } else {
                        ?>
                        <button  style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="$('#modal-pull-product').modal('show', {backdrop: 'true'});"><i class="fa fa-plus"></i> ดึงรายการสินค้า</button>;
                        <span style="float: right">&nbsp;</span>
                        <?php
                    }
                    ?>
                    <button  type="button" style="float: right" value="0" onclick="open_filter(this);" class="btn btn-sm btn-rounded btn-outline-warning"><i class="fa fa-search"></i> ค้นหาขั้นสูง</button>
                </h4> 
                <div id="filter-group" style="display:none;">
                    <form class="form-material m-t-10" onsubmit="return false;" >
                        <br/>
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-control" id="product_category_id_filter">
                                    <?php
                                    $product_category = $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'))->get('product_category');
                                    ?>
                                    <option value="">หมวดหมู่ทั้งหมด</option>
                                    <?php
                                    foreach ($product_category->result() as $row) {
                                        ?>
                                        <option <?php echo ($product_category_id == $row->product_category_id) ? 'selected' : ''; ?> value="<?php echo $row->product_category_id; ?>"><?php echo $row->product_category_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="status_product_id_filter">
                                    <?php
                                    $status_product = $this->db->get('ref_status_product');
                                    ?>
                                    <option value="">สถานะสินค้าทั้งหมด</option>
                                    <?php
                                    foreach ($status_product->result() as $row) {
                                        ?>
                                        <option value="<?php echo $row->status_product_id; ?>"><?php echo $row->status_product_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-success btn-sm" onclick="ajax();"><b><i class="fa fa-search"></i>&nbsp; ค้นหาจากตัวเลือก</b></button>
                            </div>
                        </div>
                    </form>
                    <hr style="border: 1px solid #ddd">
                </div>


                <div class="table-responsive" id="result-page"></div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="open-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade in" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'product/delete' ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body text-center"><b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่ &nbsp;<i class="fa fa-question-circle"></i></b></div>
                    <input type="hidden" name="delete_id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger" id="delete_bt_modal" value="1"><i class="fa fa-trash"></i>&nbsp;ตกลง</button>
                    <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade in" id="modal-delete-no">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center"><b style="color: #F89A14;">ไม่สามารถลบข้อมูลนี้ได้ เนื่องจากข้อมูลมีการถูกใช้งาน &nbsp;<i class="fa fa-warning"></i></b></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade in" id="modal-pull-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'product/pull'; ?>" onsubmit="return pull_product();" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-database"></i>&nbsp;ดึงรายการสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body text-center"><b>ต้องการดึงรายการสินค้าจากร้านหลัก ใช่หรือไม่ &nbsp;<i class="fa fa-question-circle"></i></b></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success" ><i class="fa fa-plus"></i>&nbsp;ตกลง</button>
                    <button type="button" class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="import_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    นำเข้าไฟล์ (CSV)
                    <a href="<?php echo base_url() . 'assets/product_form.csv'; ?>" class="btn btn-info btn-sm"><i class="fa fa-download"></i>&nbsp;ดาวน์โหลดแบบฟอร์ม</a>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">

                    <form method="post" action="<?php echo base_url() . 'product/import'; ?>" onsubmit="return submit_import();" enctype="multipart/form-data" autocomplete="off">

                        <div class="row">
                            <label class="col-sm-4 control-label text-right">หมวดหมู่สินค้า</label>
                            <div class="col-sm-6">
                                <select name="product_category_id" class="form-control form-control-sm" required="">
                                    <option value="">-- เลือกหมวดหมู่ --</option>
                                    <?php
                                    $groups = $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'))->get('product_category');
                                    if ($groups->num_rows() > 0) {
                                        foreach ($groups->result() as $row) {
                                            ?>
                                            <option value="<?php echo $row->product_category_id; ?>"><?php echo $row->product_category_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <input type="file" name="file" accept=".csv" class="form-control form-control-sm" required=""/>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>

                    </form>

                </div>                    
            </div>
        </div>
    </div>
</div>