<?php $__env->startSection('title', '注文完了'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>注文が完了しました</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <p>ご注文ありがとうございました。商品一覧ページに戻ります。</p>

    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">商品一覧ページへ戻る</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/cart/orderComplete.blade.php ENDPATH**/ ?>