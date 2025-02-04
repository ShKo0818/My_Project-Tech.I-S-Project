<?php $__env->startSection('title', 'テックフルーツ　ホーム'); ?>

<?php echo csrf_field(); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>テックフルーツへようこそ <?php echo e(Auth::user()->name); ?> さん　 会員データ：(<?php echo e(ucfirst(Auth::user()->user_type)); ?>)</h1>
    <div class="title">
        <!-- 他の内容があればここに追加 -->

        <div>(自主制作ページです）</div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <p>商品管理システムへようこそ</p>
    <p>最終更新</p>
        <section class="news">
            <div class= "inner">
                <h2 class= "sub-title">NEWS</h2>
            <!-- ここからニュース記事 -->
            <iframe src="<?php echo e(route('news')); ?>" width="600" height="150">
    インラインフレーム対応ブラウザでご覧いただけます。
</iframe>

             <ul class="news_list">
                <li class="news_list_item">
                    <a href=""></a>
                     <div class="news_list_date">
                        <time><script type="text/javascript"><!--
                            document.write('最終更新日:' + document.lastModified);
                                // --></script></time>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script> console.log('Hi!'); </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/home.blade.php ENDPATH**/ ?>