<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sach thuong hieu thoi trang</h1>
        <a href="?c=brand&m=add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Them moi</a>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Thuong hieu</th>
                        <th>Logo</th>
                        <th>Thong tin</th>
                        <th>Trang thai</th>
                        <th>Ngay tao</th>
                        <th colspan="2" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listBrands as $key => $item): ?>
                        <tr>
                            <td><?= $key+1; ?></td>
                            <td><?= $item['name']; ?></td>
                            <td>
                                <img class="img-fluid" src="<?= $pathLogo . $item['logo']; ?>" alt="<?= $item['name']; ?>" />
                            </td>
                            <td>
                                <p><?= $item['description']; ?></p>
                            </td>
                            <td>
                                <?= $item['status'] == 1 ? 'Active' : 'Inactive'; ?>
                            </td>
                            <td><?= $item['created_at']; ?></td>
                            <td>
                                <a href="index.php?c=brand&m=edit&id=<?= $item['id']; ?>" class="btn btn-info"> Edit</a>
                            </td>
                            <td>
                                <button class="btn btn-danger"> Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>