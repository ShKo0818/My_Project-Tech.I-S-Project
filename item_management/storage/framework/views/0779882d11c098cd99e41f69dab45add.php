

<?php $__env->startSection('title', 'Dashboard'); ?>



<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>ようこそ <?php echo e(Auth::user()->name); ?> さん</h1>

    <?php if(Auth::user()->user_type === 'corporate'): ?>
        <p>会社名: <?php echo e(Auth::user()->company_name); ?></p>
    <?php elseif(Auth::user()->user_type === 'master'): ?>
        <p>社員番号: <?php echo e(Auth::user()->membership_number); ?></p>
    <?php endif; ?>

    <div class="title">
        <!-- 他の内容があればここに追加 -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <p>最終更新</p>
        <section class="news">
            <div class= "inner">
                <h2 class= "sub-title">NEWS</h2>
            <!-- ここからニュース記事 -->
            <iframe src="/news" width="600" height="150">
    インラインフレーム対応ブラウザでご覧いただけます。
</iframe>


             <<ul class="news_list">
    <li class="news_list_item">
        <a href="">
            <div class="news_list_date">
                <time>
                    <script type="text/javascript">
                        document.write('最終更新日:' + document.lastModified);
                    </script>
                </time>
                <p class="news_item">おしらせ</p>
            </div>
            <p>サイトリニューアルしました</p>
            <button type="button" class="btn btn-primary">Primary</button>
            <span class="arrow"></span>
        </a>
    </li>
</ul>


            </div>
            
        </div>
</iframe>        

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script> console.log('Hi!'); </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/home-corp.blade.php ENDPATH**/ ?>