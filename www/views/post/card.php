        <article class="col-12 col-md-3 mb-4 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $post->getName(); ?></h5>
                    <p class="card-text"><?= App\Helpers\Text::excerpt($post->getContent(), 150); ?>...</p>
                </div>
                <?php foreach($cats as $cat):
                        $category_url = $router->url('category', ['id' => $cat->getID(), 'slug' => $cat->getSlug()]);
                        echo '<a href="'.$category_url.'"><li>'.$cat->getName().'</li></a>';
                endforeach; ?>
                <a href="<?= $router->url('post',['id' => $post->getId(), 'slug'=>$post->getSlug()]); ?>" class="text-center pb-2">Lire plus</a>
                <div class="card-footer text-muted">
                    <?= ($post->getCreatedAt())->format('d/m/Y H:i'); ?>
                </div>
            </div>
        </article>
