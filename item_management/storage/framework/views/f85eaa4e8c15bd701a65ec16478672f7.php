

<?php $__env->startSection('title', '発注確認'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>発注確認</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h4>以下の内容で発注してよろしいですか？</h4>

    <div class="form-group">
        <label>商品名</label>
        <p><?php echo e($order['item_name']); ?></p>
    </div>

    <div class="form-group">
        <label>発注数</label>
        <p><?php echo e($order['quantity']); ?></p>
    </div>

    <div class="form-group">
        <label>金額</label>
        <p><?php echo e($order['price']); ?></p>
    </div>

    <div class="form-group">
        <label>カテゴリ</label>
        <p><?php echo e($order['category']); ?></p>
    </div>

    <div class="form-group">
        <label>メーカー名</label>
        <p><?php echo e($order['company_name']); ?></p>
    </div>

    <!-- 発注確認ボタン -->
    <form action="<?php echo e(route('order.finalStore')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-success">はい、発注します</button>
    </form>

    <!-- 発注中止ボタン -->
    <form action="<?php echo e(route('order.create')); ?>" method="GET">
        <button type="submit" class="btn btn-danger">いいえ、戻ります</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/orders/confirm.blade.php ENDPATH**/ ?>