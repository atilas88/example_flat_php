<?php $title = 'Ws Page' ?>
<form class="form_class" method="post" action="/prueba/index.php/ws">
    <fieldset>
        <legend><?= $GLOBALS["lang"]["get_data"] ?></legend>
        <div class="field_class">
        <div class="flex_div">
            <label for="url"><?= $GLOBALS["lang"]["url"] ?></label>
            <input type="text" class="" id="url" name="url" class="input-text" value="" required >
        </div>
        <?php if (isset($this->errors['url'])): ?>
            <?php foreach ($this->errors['url'] as $rule => $message): ?>
                <small class="error"><?= $message ?></small>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="field_class">
        <div class="flex_div">
        <label for="method"><?= $GLOBALS["lang"]["method"] ?></label>
            <select name="method" id="method">
                <option value="get">Get</option>
                <option value="post">Post</option>
            </select>
        </div>
            
        </div>
    </fieldset>
    <div class="btn_area">
        <a href="/prueba/index.php/" class="btn"><?= $GLOBALS["lang"]["back"] ?></a>
        <input type="submit" name="request_ws" class="btn" value="<?= $GLOBALS["lang"]["get_ws"] ?>">
    </div>
</form>
<br>
<div class="table_container">
<?php if (count($this->data) > 0): ?>
    <div class="table_overflow_x">
        <table>
            <thead>
                <tr>
                    <?php foreach (array_keys((array) $this->data[0]) as $key): ?>
                        <th><?= htmlspecialchars($key) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->data as $item): ?>
                    <tr>
                        <?php foreach ((array) $item as $value): ?>
                            <td>
                                <?php
                                    echo $value;
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <div class="empty_msg">
            <h2><?= $GLOBALS["lang"]["not_data"] ?></h2>
        </div>
    <?php endif; ?>
</div>