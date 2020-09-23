<?php include ROOT . '/views/layouts/header.php';?>
<?php if ($result): ?>
    <p>Элемент удален!</p>
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
        <form enctype="multipart/form-data" id="del-element" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Название элемента</label>
                <div class="col-sm-10">
                    <input disabled id="inputName" class="form-control" type="text" placeholder="Название элемента" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $element['name'];?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="selectType" class="col-sm-2 control-label">Тип</label>
                <div class="col-sm-10">
                    <select disabled id="selectType" name="type" class="form-control">
                        <?php echo Element::getTypeElement($element); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="selectNode" class="col-sm-2 control-label">Раздел</label>
                <div class="col-sm-10">
                    <select disabled name="node_id" id="selectNode" class="form-control">
                        <option value="<?php echo $element['node_id']; ?>">
                            <?php 
                                $nodeParent = Node::getNodeById($element['node_id']);
                                echo $nodeParent['name'];
                            ?>
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="textareaData" class="col-sm-2 control-label">Произвольные данные</label>
                <div class="col-sm-10">
                    <textarea disabled id="textareaData" rows="3" class="form-control" placeholder="Произвольные данные" name="data"><?php if(isset($_POST['data'])) echo $_POST['data']; else echo $element['data'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" name="element_id" value="<?php echo $element['id']; ?>">
                    <input type="submit" name="del-element" value="Удалить" class="btn btn-danger" />
                    <a href="/" class="btn btn-default">Назад</a>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
<?php include ROOT . '/views/layouts/footer.php';?>
