<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chinh sua thuong hieu</h1>
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

            <form class="border p-3" method="post" action="?c=brand&m=handleEdit&id=<?= $infoBrand['id']; ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label> Ten thuong hieu (*)</label>
                    <input value="<?= htmlentities($infoBrand['name']); ?>" type="text" class="form-control" name="nameBrand" />
                </div>
                <div class="form-group">
                    <label> Logo thuong hieu (*)</label>
                    <input type="file" name="logoBrand" />
                    <p>
                        <img width="30%" height="30%" class="img-fluid" src="<?= $pathLogo . $infoBrand['logo']; ?>"/>
                    </p>
                </div>
                <div class="form-group">
                    <label> Trang thai</label>
                    <select class="form-control" name="statusBrand">
                        <option <?= $infoBrand['status'] == 1 ? 'selected' : ''; ?> value="1"> Active</option>
                        <option <?= $infoBrand['status'] == 0 ? 'selected' : ''; ?> value="0"> Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label> Chi tiet ve thuong hieu</label>
                    <textarea class="form-control" rows="8" name="descBrand"><?= htmlentities($infoBrand['description']); ?></textarea>
                </div>
                <button type="submit" name="btnEditBrand" class="btn btn-primary"> Submit </button>
            </form>
        </div>
    </div>
</div>