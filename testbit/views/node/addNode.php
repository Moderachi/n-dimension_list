<?php include ROOT . '/views/layouts/header.php';?>
<?php if ($result): ?>
    <p>Раздел добавлен!</p>
    <a href="/" class="btn btn-default">Назад</a>
<?php else: ?>
    <?php if (isset($errors) && is_array($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div>
        <form enctype="multipart/form-data" id="add-node" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Название раздела</label>
                <div class="col-sm-10">
                    <input id="inputName" class="form-control" type="text" placeholder="Название раздела" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="textareaDescription" class="col-sm-2 control-label">Описание раздела</label>
                <div class="col-sm-10">
                    <textarea id="textareaDescription" rows="3" class="form-control" placeholder="Описание раздела" name="description"><?php if(isset($_POST['data'])) echo $_POST['description'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="selectNode" class="col-sm-2 control-label">Выберите раздел</label>
                <div class="col-sm-10">
                    <select name="parent_id" id="selectNode" class="form-control">
                        <option value="-1">Нет</option>
                        <?php foreach (Node::getNodeNotChild($nodes) as $node): ?>
                            <option value="<?php echo $node['id']; ?>">
                                <?php echo $node['name']; ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="add-node" value="Добавить" class="btn btn-success" />
                    <a href="/" class="btn btn-default">Назад</a>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
<?php include ROOT . '/views/layouts/footer.php';?>
