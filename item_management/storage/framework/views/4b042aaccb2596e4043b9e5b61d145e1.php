<?php $__env->startSection('title', '買い物カゴ'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>買い物カゴ</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>数量</th>
                <th>小計</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $subtotal = $item['price'] * $item['quantity']; ?>
                <tr>
                    <!-- 画像が存在する場合に表示
                    <td>
                        <?php if(isset($item['image'])): ?>
                            <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>" width="50">
                        <?php else: ?>
                            <span>画像なし</span>
                        <?php endif; ?>
                    </td> -->
                    <td><?php echo e($item['name']); ?></td>
                    <td>¥<?php echo e(number_format($item['price'])); ?></td>
                    <td><?php echo e($item['quantity']); ?></td>
                    <td>¥<?php echo e(number_format($subtotal)); ?></td>
                    <td>
                        <form action="<?php echo e(route('cart.remove')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="item_id" value="<?php echo e($id); ?>">
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
                <?php $total += $subtotal; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <h3>合計: ¥<?php echo e(number_format($total)); ?></h3>

    <form action="<?php echo e(route('cart.clear')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-warning">カートを空にする</button>
    </form>

    <a href="<?php echo e(route('cart.checkout')); ?>" class="btn btn-primary mt-3">購入手続きへ</a>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/cart/index.blade.php ENDPATH**/ ?>