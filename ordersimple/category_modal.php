<!-- Edit Product -->
<div class="modal fade" id="editcategory<?php echo $row['categoryid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">ИЗМЕНИТЬ КАТЕГОРИЮ</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="editcategory.php?category=<?php echo $row['categoryid']; ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-3" style="margin-top:7px;">
                                <label class="control-label">НАЗВАНИЕ КАТЕГОРИИ</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo $row['catname']; ?>" name="cname">
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ЗАКРЫТЬ</button>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> ОБНОВИТЬ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletecategory<?php echo $row['categoryid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">УДАЛИТЬ КАТЕГОРИЮ</h4></center>
            </div>
            <div class="modal-body">
                <h3 class="text-center"><?php echo $row['catname']; ?></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ЗАКРЫТЬ</button>
                <a href="delete_category.php?category=<?php echo $row['categoryid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> ДА</a>
                </form>
            </div>
        </div>
    </div>
</div>