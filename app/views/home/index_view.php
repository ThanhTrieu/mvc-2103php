<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <div class="col">
            <h4>Thong tin nguoi dung!</h4>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>birthday</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listUser as $key => $item): ?>
                        <tr>
                            <td><?= $item['id']; ?></td>
                            <td><?= $item['email']; ?></td>
                            <td><?= $item['phone']; ?></td>
                            <td><?= $item['address']; ?></td>
                            <td><?= $item['gender'] === 1 ? 'Nam' : 'Nu' ; ?></td>
                            <td><?= $item['birthday']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>