<?php include ROOT . '/views/layouts/header.php';?>
<?php if ($result): ?>
    <p>Элемент добавлен!</p>
    <a href="/" class="btn btn-default">Назад</a>
<?php else: ?>
    <?php if (isset($errors) && is_array($errors)): ?>
        <ul class="text-danger">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div>
        <form enctype="multipart/form-data" id="add-element" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Название элемента</label>
                <div class="col-sm-10">
                    <input id="inputName" class="form-control" type="text" placeholder="Название элемента" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="selectType" class="col-sm-2 control-label">Выберите тип</label>
                <div class="col-sm-10">
                    <select id="selectType" class="form-control" name="type" >
                        <option selected disabled>Выберите тип</option>
                        <option value="n">Новость</option>
                        <option value="a">Статья</option>
                        <option value="r">Отзыв</option>
                        <option value="c">Комментарий</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="selectNode" class="col-sm-2 control-label">Выберите раздел</label>
                <div class="col-sm-10">
                    <select name="node_id" class="form-control" id="selectNode" >
                        <option selected disabled>Выберите раздел</option>
                        <?php foreach (Node::getNodeNotChild(Node::getNodesList()) as $node): ?>
                            <option value="<?php echo $node['id']; ?>">
                                <?php echo $node['name']; ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="textareaData" class="col-sm-2 control-label">Произвольные данные</label>
                <div class="col-sm-10">
                    <textarea id="textareaData" class="form-control" rows="3" placeholder="Произвольные данные" name="data"><?php if(isset($_POST['data'])) echo $_POST['data'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="add-element" value="Добавить" class="btn btn-success" />
                    <a href="/" class="btn btn-default">Назад</a>
                    
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
<?php include ROOT . '/views/layouts/footer.php';?>
