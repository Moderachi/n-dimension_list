<?php include ROOT . '/views/layouts/header.php';?>
<?php if ($result): ?>
    <p>Элемент изменен!</p>
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
        <form enctype="multipart/form-data" id="edit-element" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Название элемента</label>
                <div class="col-sm-10">
                    <input id="inputName" class="form-control" type="text" placeholder="Название элемента" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $element['name'];?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="selectType" class="col-sm-2 control-label">Выберите тип</label>
                <div class="col-sm-10">
                    <select id="selectType" name="type" class="form-control">
                        <?php echo Element::getTypeElement($element); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="selectNode" class="col-sm-2 control-label">Выберите раздел</label>
                <div class="col-sm-10">
                    <select name="node_id" id="selectNode" class="form-control">
                        <?php foreach (Node::getNodeNotChild(Node::getNodesList()) as $node): ?>
                            <option <?php if($node['id'] == $element['node_id']) echo 'selected';?> value="<?php echo $node['id']; ?>">
                                <?php echo $node['name']; ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="textareaData" class="col-sm-2 control-label">Произвольные данные</label>
                <div class="col-sm-10">
                    <textarea id="textareaData" rows="3" class="form-control" placeholder="Произвольные данные" name="data"><?php if(isset($_POST['data'])) echo $_POST['data']; else echo $element['data'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="edit-element" value="Редактировать" class="btn btn-success" />
                    <a href="/" class="btn btn-default">Назад</a>
                    
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
<?php include ROOT . '/views/layouts/footer.php';?>
