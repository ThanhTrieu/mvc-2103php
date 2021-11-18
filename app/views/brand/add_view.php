<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Them moi thuong hieu</h1>
        <a href="?c=brand" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Danh sach</a>
    </div>
    <div class="row">
        <div class="col">

            <?php if(!empty($messErrors)): ?>
                <ul>
                    <?php foreach($messErrors as $err): ?>
                        <?php if(!empty($err)): ?>
                            <li class="text-danger"><?= $err; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if(!empty($existName)): ?>
                <p class="text-danger">Thuong hieu <b><?= $existName; ?></b> da ton tai, vui long nhap ten khac</p>
            <?php endif; ?>

            <?php if($state === 'fail'): ?>
                <p class="text-danger"> Co loi xay ra, vui long thu lai sau</p>
            <?php endif; ?>

            <form class="border p-3" method="post" action="?c=brand&m=handleAdd" enctype="multipart/form-data">
                <div class="form-group">
                    <label> Ten thuong hieu (*)</label>
                    <input type="text" class="form-control" name="nameBrand" />
                </div>
                <div class="form-group">
                    <label> Logo thuong hieu (*)</label>
                    <input type="file" name="logoBrand" />
                </div>
                <div class="form-group">
                    <label> Chi tiet ve thuong hieu</label>
                    <textarea class="form-control" rows="8" name="descBrand"></textarea>
                </div>
                <button type="submit" name="btnAddBrand" class="btn btn-primary"> Submit </button>
            </form>
        </div>
    </div>
</div>