<?php include ROOT . '/views/layouts/header.php';?>
<?php if ($result): ?>
    <p>Раздел удален!</p>
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
        <form enctype="multipart/form-data" id="del-node" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Название раздела</label>
                <div class="col-sm-10">
                    <input disabled id="inputName" class="form-control" type="text" placeholder="Название раздела" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $node['name'];?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="textareaDescription" class="col-sm-2 control-label">Описание раздела</label>
                <div class="col-sm-10">
                    <textarea disabled id="textareaDescription" rows="3" class="form-control" placeholder="Описание раздела" name="description"><?php if(isset($_POST['data'])) echo $_POST['description']; else echo $node['description'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="selectNode" class="col-sm-2 control-label">Раздел</label>
                <div class="col-sm-10">
                    <select disabled name="parent_id" id="selectNode" class="form-control">
                        <option value="<?php echo $node['parent_id']; ?>">
                            <?php 
                                if($node['parent_id'] == -1) echo 'Нет'; 
                                else
                                {   
                                    $nodeParent = Node::getNodeById($node['parent_id']);
                                    echo $nodeParent['name'];
                                } 
                            ?>
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" name="node_id" value="<?php echo $node['id']; ?>">
                    <input type="submit" name="del-node" value="Удалить" class="btn btn-danger" />
                    <a href="/" class="btn btn-default">Назад</a>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
<?php include ROOT . '/views/layouts/footer.php';?>
