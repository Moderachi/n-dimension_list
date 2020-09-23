<?php include ROOT . '/views/layouts/header.php';?>
<?php if ($result): ?>
    <p>Раздел обновлен!</p>
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
        <form enctype="multipart/form-data" id="edit-node" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Название раздела</label>
                <div class="col-sm-10">
                    <input id="inputName" class="form-control" type="text" placeholder="Название раздела" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $node['name'];?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="textareaDescription" class="col-sm-2 control-label">Описание раздела</label>
                <div class="col-sm-10">
                    <textarea id="textareaDescription" rows="3" class="form-control" placeholder="Описание раздела" name="description"><?php if(isset($_POST['data'])) echo $_POST['description']; else echo $node['description'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="selectNode" class="col-sm-2 control-label">Выберите раздел</label>
                <div class="col-sm-10">
                    <select name="parent_id" id="selectNode" class="form-control">
                        <option value="-1">Нет</option>
                        <?php foreach (Node::getNodeNotChild(Node::getNodesList()) as $nodeItem): ?>
                            <?php if($node['id'] == $nodeItem['id']) continue; ?>
                            <option value="<?php echo $nodeItem['id']; ?>">
                                <?php echo $nodeItem['name']; ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="edit-node" value="Редактировать" class="btn btn-success" />
                    <a href="/" class="btn btn-default">Назад</a>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
<?php include ROOT . '/views/layouts/footer.php';?>
