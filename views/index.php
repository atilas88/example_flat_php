<?php $title = 'Lodging Page' ?>
<form class="form_class" method="post" action="/prueba/index.php/">
    <fieldset>
        <legend><?= $GLOBALS["lang"]["get_data"] ?></legend>
        <div class="field_class">
            <div class="flex_div">
                <label for="server"><?= $GLOBALS["lang"]["server"] ?></label>
                <input type="text" class="" id="server" name="server"  value="" required>
            </div>
            <?php if (isset($this->errors['server'])): ?>
                <?php foreach ($this->errors['server'] as $rule => $message): ?>
                    <small class="error"><?= $message ?></small>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="field_class">
        <div class="flex_div">
            <label for="database"><?= $GLOBALS["lang"]["database"] ?></label>
            <input type="text" class="" id="database" name="database" class="input-text" value="" required >
        </div>
        <?php if (isset($this->errors['database'])): ?>
                <?php foreach ($this->errors['database'] as $rule => $message): ?>
                    <small class="error"><?= $message ?></small>
                <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="field_class">
        <div class="flex_div">
            <label for="user"><?= $GLOBALS["lang"]["user"] ?></label>
            <input type="text" class="" id="user" name="user" class="input-text" value="" required >
        </div>
        <?php if (isset($this->errors['user'])): ?>
            <?php foreach ($this->errors['user'] as $rule => $message): ?>
                <small class="error"><?= $message ?></small>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="field_class">
        <div class="flex_div">
            <label for="password"><?= $GLOBALS["lang"]["password"] ?></label>
            <input type="password" class="" id="password" name="password" class="input-text" value="" required >
        </div>
        <?php if (isset($this->errors['password'])): ?>
            <?php foreach ($this->errors['password'] as $rule => $message): ?>
                <small class="error"><?= $message ?></small>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>

    </fieldset>


    <div class="btn_area">
        <a href="/prueba/index.php/ws" class="btn"><?= $GLOBALS["lang"]["get_ws"] ?></a>
        <input type="submit" name="request" class="btn" value="<?= $GLOBALS["lang"]["get_data"] ?>">
    </div>
</form>
<br>
<div class="table_container">
    <?php if ($this->data instanceof \Generator): ?>
        <div class="table_overflow_x">
            <table>
                <thead>
                    <tr>
                        <?php foreach (array_keys((array) $this->data->current()) as $key): ?>
                            <th><?= htmlspecialchars($key) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->data as $lodging): ?>
                        <tr>
                            <?php foreach ((array) $lodging as $value): ?>
                                <td>
                                    <?php
                                        if (isset($value)) {
                                            echo $value instanceof \DateTime ? $value->format('Y-m-d H:i:s') : htmlspecialchars($value);
                                        }
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
