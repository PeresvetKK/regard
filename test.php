<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($_GET["ajax"] == "y"): ?>
    <? if ($arResult["SHOW_SMS_FIELD"] == true): ?>
        <?
        // TODO: доделать потом. Ошибка таймера + сделать активацию пользователя после подтверждения смс
        ?>
        <script type="text/javascript" src="/bitrix/js/main/core/core.min.js"></script>
        <script type="text/javascript" src="/bitrix/js/main/core/core_phone_auth.min.js"></script>

        <div class="authorization authorization-confirm authorization__widnow">
            <div class="authorization__box">
                <button class="authorization__closeBtn authorization__closeBtn-recover close-btn">
                </button>

                <form id="authorization-confirmPhone"
                      class="authorization__form authorization__form-confirm"
                      method="post"
                      action="<?= $arResult["AUTH_URL"] ?>"
                      name="regform">

                    <input type="hidden" name="SIGNED_DATA"
                           value="<?= htmlspecialcharsbx($arResult["SIGNED_DATA"]) ?>"/>

                    <h4 class='authorization__title'>
                        Ваше смс с кодом подтверждения должно прибыть в ближайшее время.
                    </h4>
                    <div class="authorization__changingText">
                        <p>Если сообщение не приходит, попробуйте еще раз или обратитесь <br> в
                            нашу поддержку.
                        </p>

                        <? // reSend
                        ?>

                        <span class="authorization__resendTimer flexbox">Отправить повторно через
                            <span class="authorization__resendTimerCounter"><?= $arResult["PHONE_CODE_RESEND_INTERVAL"] ?></span>
                        </span>

                        <button type='button' disabled class="authorization__changingResend button-s">отправить
                            снова
                        </button>
                    </div>

                    <? // code
                    ?>
                    <div class="authorization__inputBox">
                        <label for="smsConfirm" class="authorization__error error"></label>
                        <input id="smsConfirm" name="SMS_CODE" type="number"
                               class="authorization__input"
                               placeholder="<? echo GetMessage("main_register_sms_code") ?>" maxlength="255"
                               value="<?= htmlspecialcharsbx($arResult["SMS_CODE"]) ?>" autocomplete="off">
                    </div>

                    <button type="submit" form="authorization-confirmPhone"
                            class="authorization__submit">
                        <? echo GetMessage("main_register_sms_send") ?>
                    </button>
                </form>

                <script>
                    new BX.PhoneAuth({
                        containerId: 'bx_register_resend',
                        errorContainerId: 'bx_register_error',
                        interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
                        data:
                        <?=CUtil::PhpToJSObject([
                            'signedData' => $arResult["SIGNED_DATA"],
                        ])?>,
                        onError:
                            function (response) {
                                var errorNode = BX('bx_register_error');
                                errorNode.innerHTML = '';
                                for (var i = 0; i < response.errors.length; i++) {
                                    errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br />';
                                }
                                errorNode.style.display = '';
                                checkOpt();
                            }
                    });
                </script>

                <div id="bx_register_error" style="display:none" class="alert alert-danger"></div>

                <div id="bx_register_resend"></div>

            </div>
        </div>

    <? elseif (!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]): ?>

        <!-- РЕГИСТРАЦИЯ -->

        <div class="authorization authorization-signUp authorization__widnow tab-content" data-tab="2">
            <div class="authorization__box flexbox">
                <div class="authorization__signUp">
                    <button class="authorization__closeBtn close-btn"></button>
<!--                    <h4 class="authorization__title">Зарегистрироваться</h4>-->

                    <?
                    if (!empty($arParams["~AUTH_RESULT"])):
                        $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                        ?>
                        <div class="alert <?= ($arParams["~AUTH_RESULT"]["TYPE"] == "OK" ? "alert-success" : "alert-danger") ?>"><button type="button" class="alert-closeBtn"></button><?= nl2br(htmlspecialcharsbx($text)) ?></div>
                    <? endif ?>

                    <? // message email conformation
                    ?>
                    <? /*
                            <? if (!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"): ?>
                                <div class="alert alert-warning"><? echo GetMessage("AUTH_EMAIL_WILL_BE_SENT") ?></div>
                            <? endif ?>
                            */ ?>

                    <div class="authorization__formBox flexbox">
                        <div class="authorization__formTop flexbox">
                            <form id="authorization-signUp"
                                  class="authorization__form authorization__form-signUp"
                                  method="post"
                                  action="<?= $arResult["AUTH_URL"] ?>"
                                  name="bform"
                                  enctype="multipart/form-data">

                                <input type="hidden" name="AUTH_FORM" value="Y"/>
                                <input type="hidden" name="TYPE" value="REGISTRATION"/>

                                <? // Оптовый пользователь
                                   // TODO: убрать
                                ?>
                                <div class="authorization__checkBox">
                                    <input name="CHECK_OPT" id="checkOpt" type="checkbox"
                                           class="checkBox__input"
                                           value="1">
                                    <label for="checkOpt"
                                           class="checkBox__label">Оптовый пользователь (тестовый режим)</label>
                                </div>



                                <? // name
                                   // TODO: убрать
                                ?>
                                <div class="authorization__inputBox">
                                    <label for="nameUp" class="authorization__error error"></label>
                                    <label for="nameUp"
                                           class="authorization__label"><?= GetMessage("AUTH_NAME") ?></label>
                                    <input name="USER_NAME" id="nameUp" type="text"
                                           class="authorization__input"
                                           maxlength="255"
                                           value="<?= $arResult["USER_NAME"] ?>">
                                </div>

                                <? // last name
                                   // TODO: убрать
                                ?>
                                <div class="authorization__inputBox">
                                    <label for="lastNameUp" class="authorization__error error"></label>
                                    <label for="lastNameUp"
                                           class="authorization__label"><?= GetMessage("AUTH_LAST_NAME") ?></label>
                                    <input name="USER_LAST_NAME" id="lastNameUp" type="text"
                                           class="authorization__input"
                                           maxlength="255"
                                           value="<?= $arResult["USER_LAST_NAME"] ?>">
                                </div>

                                <? // login
                                ?>
                                <div class="authorization__inputBox">
                                    <label for="loginUp" class="authorization__error error"></label>
                                    <label for="loginUp"
                                           class="authorization__label"><?= GetMessage("AUTH_LOGIN_MIN") ?></label>
                                    <input name="USER_LOGIN" id="loginUp" type="text"
                                           class="authorization__input"
                                           maxlength="255"
                                           value="<?= $arResult["USER_LOGIN"] ?>">
                                </div>

                                <? // phone
                                ?>
                                <? //if ($arResult["PHONE_REGISTRATION"]): ?>
                                    <div class="authorization__inputBox">
                                        <label for="phoneUp" class="authorization__error error"></label>
                                        <label for="phoneUp"
                                               class="authorization__label"><? echo GetMessage("main_register_phone_number") ?><? if ($arResult["PHONE_REQUIRED"]): ?>*<? endif ?></label>
                                        <input name="USER_PHONE_NUMBER" id="phoneUp" type="text"
                                               class="authorization__input" maxlength="255"
                                               value="<?= $arResult["USER_PHONE_NUMBER"] ?>">
                                    </div>
                                <? //endif ?>

                                <? // email
                                ?>
                                <? if ($arResult["EMAIL_REGISTRATION"]): ?>
                                    <div class="authorization__inputBox">
                                        <label for="emailUp" class="authorization__error error"></label>
                                        <label for="emailUp"
                                               class="authorization__label"><?= GetMessage("AUTH_EMAIL") ?><? if ($arResult["EMAIL_REQUIRED"]): ?>*<? endif ?></label>
                                        <input name="USER_EMAIL" id="emailUp" type="email"
                                               class="authorization__input" maxlength="255"
                                               value="<?= $arResult["USER_EMAIL"] ?>">
                                    </div>
                                <? endif ?>

                                <? // pass
                                ?>
                                <div class="authorization__inputBox">
                                    <label for="passUp"
                                           class="authorization__error error"></label>
                                    <label for="passUp"
                                           class="authorization__label"><?= GetMessage("AUTH_PASSWORD_REQ") ?></label>
                                    <? if ($arResult["SECURE_AUTH"]): ?>
                                        <div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
                                            <div class="bx-authform-psw-protected-desc">
                                                <span></span><? echo GetMessage("AUTH_SECURE_NOTE") ?></div>
                                        </div>

                                        <script type="text/javascript">
                                            document.getElementById('bx_auth_secure').style.display = '';
                                        </script>
                                    <? endif ?>
                                    <input class="authorization__input" id="passUp"
                                           type="password" name="USER_PASSWORD" maxlength="255"
                                           value="<?= $arResult["USER_PASSWORD"] ?>" autocomplete="off"/>
                                </div>
                    
                                <? // rePass
                                ?>
                                <div class="authorization__inputBox">
                                    <label for="rePassUp"
                                           class="authorization__error error"></label>
                                    <label for="rePassUp"
                                           class="authorization__label"><?= GetMessage("AUTH_CONFIRM") ?></label>
                                    <? if ($arResult["SECURE_AUTH"]): ?>
                                        <div class="bx-authform-psw-protected" id="bx_auth_secure_conf"
                                             style="display:none">
                                            <div class="bx-authform-psw-protected-desc">
                                                <span></span><? echo GetMessage("AUTH_SECURE_NOTE") ?></div>
                                        </div>

                                        <script type="text/javascript">
                                            document.getElementById('bx_auth_secure_conf').style.display = '';
                                        </script>
                                    <? endif ?>
                                    <input name="USER_CONFIRM_PASSWORD" id="rePassUp" type="password"
                                           class="authorization__input" maxlength="255"
                                           value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" autocomplete="off">
                                </div>


                                <div class="opt__inputs hidden-div">
                                    <div class="authorization__inputBox">
                                        <label for="company" class="authorization__error error"></label>
                                        <label for="company"
                                               class="authorization__label">Название организации</label>
                                        <input name="WORK_COMPANY" id="company" type="text"
                                               class="authorization__input"
                                               maxlength="255"
                                               value="">
                                    </div>

                                    <div class="authorization__inputBox">
                                        <label for="inn" class="authorization__error error"></label>
                                        <label for="inn"
                                               class="authorization__label">ИНН</label>
                                        <input name="UF_WORK_INN" id="inn" type="text"
                                               class="authorization__input"
                                               maxlength="255"
                                               value="">
                                    </div>

                                    <div class="authorization__inputBox">
                                        <label for="country" class="authorization__error error"></label>
                                        <label for="country"
                                               class="authorization__label">Страна</label>

                                        <select class="authorization__input" name="WORK_COUNTRY" id="country">
                                            <?php foreach ($GLOBALS['countryList'] as $countryKey => $country): ?>
                                                <option value="<?=$countryKey; ?>"><?=$country; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="authorization__inputBox">
                                        <label for="city" class="authorization__error error"></label>
                                        <label for="city"
                                               class="authorization__label">Город</label>
                                        <input name="WORK_CITY" id="city" type="text"
                                               class="authorization__input"
                                               maxlength="255"
                                               value="">
                                    </div>
                                </div>

                                <? // Captcha  ?>

                              <? if ($arResult["CAPTCHA_CODE"]): ?>
                                    <div class="authorization__inputBox">
                                        <input type="hidden" name="captcha_sid"
                                               value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                                        <label class="authorization__error error"></label>
                                        <label for="captchaUp"
                                               class="authorization__label"><? echo GetMessage("CAPTCHA_REGF_PROMT") ?></label>
                                        <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>
                                             width="180" height="40" alt="CAPTCHA"/>
                                        <input class="authorization__input" id="captchaUp"
                                               type="text" name="captcha_word" maxlength="50" value=""
                                               autocomplete="off"/>
                                    </div>

    
                                <? endif; ?>
                            </form>
                        </div>
                        <button type="submit" form="authorization-signUp"
                                class="authorization__submit authorization__submit-signUp">Зарегистрироваться
                        </button>

                        <? // Политика конфиденциальности
                        ?>
                        <div class="flexbox authorization__policity">
                            Регистрируясь вы соглашаетесь с
                            <span class="authorization__policityBtn policityBtn">политикой
                                                                конфиденциальности
                        </div>
                        <button href="<?= $arResult["AUTH_AUTH_URL"] ?>"
                                class="nav__barLink nav__barUserAuthItem nav__barUserAuthItem-inset nav__barUserAuthItem-login Blink">
                            <?= GetMessage("AUTH_AUTH") ?>
                        </button>
                        <div class="modal modal-policity flexbox">
                            <button class="modal__closeBtn"></button>
                            <div class="modal__box">
                                <button class="modal__closeBtn modal__closeBtn-inset"></button>
                                <div class="modal__content">
                                    <h3 class="modal__title">Политика конфиденциальности</h3>
                                    <? $APPLICATION->IncludeFile("/include/main/pp.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Recaptchafree.reset();
            function checkOpt() {
                let check_opt = document.getElementById('checkOpt'),
                    opt__inputs = document.querySelector('.opt__inputs');

                check_opt.addEventListener('change', (e) => {
                    opt__inputs.classList.toggle('hidden-div');
                });
            }
            checkOpt();
        </script>
    <? endif ?>


    <?
    if (!empty($arParams["~AUTH_RESULT"]) && $arParams["~AUTH_RESULT"]["TYPE"] == "OK"):
        $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
        ?>
        <div class="authorization authorization-message authorization__widnow">
            <div class="authorization__box">
                <button class="authorization__closeBtn authorization__closeBtn-recover close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42"
                         viewBox="0 0 42 42" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M21 1C9.95431 1 1 9.9543 0.999999 21C0.999996 32.0457 9.9543 41 21 41C32.0457 41 41 32.0457 41 21C41 9.95431 32.0457 1.00001 21 1Z">
                        </path>
                    </svg>
                </button>

                <?php if ($_REQUEST['CHECK_OPT']): ?>
                    <h4 class='authorization__title'>
                        Спасибо за регистрацию
                    </h4>
                    <p>
                        Менеджер свяжется с вами в ближайшее время.
                    </p>
                <?php else: ?>
                    <h4 class='authorization__title'>
                        <?= nl2br(htmlspecialcharsbx($text)) ?>
                    </h4>

                    <? if ($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]): ?>
                        <p>
                            <? echo GetMessage("AUTH_EMAIL_SENT") ?>
                        </p>
                    <? endif ?>
                <? endif ?>

            </div>
        </div>
    <? endif ?>

<?
else:

    if ($arResult["SHOW_SMS_FIELD"] == true) {
        CJSCore::Init('phone_auth');
    }

    //one css for all system.auth.* forms
    $APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
    ?>
    <div class="bx-authform">
        <noindex>

            <?
            if (!empty($arParams["~AUTH_RESULT"])):
                $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                ?>
                <div class="alert <?= ($arParams["~AUTH_RESULT"]["TYPE"] == "OK" ? "alert-success" : "alert-danger") ?>"><button type="button" class="alert-closeBtn"></button><?= nl2br(htmlspecialcharsbx($text)) ?></div>
            <? endif ?>

            <? if ($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]): ?>
                <div class="alert alert-success"><? echo GetMessage("AUTH_EMAIL_SENT") ?></div>
            <? endif ?>

            <? if (!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"): ?>
                <div class="alert alert-warning"><? echo GetMessage("AUTH_EMAIL_WILL_BE_SENT") ?></div>
            <? endif ?>

            <? if ($arResult["SHOW_SMS_FIELD"] == true): ?>

                <form method="post" action="<?= $arResult["AUTH_URL"] ?>" name="regform">

                    <input type="hidden" name="SIGNED_DATA"
                           value="<?= htmlspecialcharsbx($arResult["SIGNED_DATA"]) ?>"/>

                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-label-container"><span
                                    class="bx-authform-starrequired">*</span><? echo GetMessage("main_register_sms_code") ?>
                        </div>
                        <div class="bx-authform-input-container">
                            <input type="text" name="SMS_CODE" maxlength="255"
                                   value="<?= htmlspecialcharsbx($arResult["SMS_CODE"]) ?>" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="bx-authform-formgroup-container">
                        <input type="submit" class="btn btn-primary" name="code_submit_button"
                               value="<? echo GetMessage("main_register_sms_send") ?>"/>
                    </div>

                </form>

                <script>
                    new BX.PhoneAuth({
                        containerId: 'bx_register_resend',
                        errorContainerId: 'bx_register_error',
                        interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
                        data:
                        <?=CUtil::PhpToJSObject([
                            'signedData' => $arResult["SIGNED_DATA"],
                        ])?>,
                        onError:
                            function (response) {
                                var errorNode = BX('bx_register_error');
                                errorNode.innerHTML = '';
                                for (var i = 0; i < response.errors.length; i++) {
                                    errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br />';
                                }
                                errorNode.style.display = '';
                            }
                    });
                </script>

                <div id="bx_register_error" style="display:none" class="alert alert-danger"></div>

                <div id="bx_register_resend"></div>

            <? elseif (!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]): ?>

                <form method="post" action="<?= $arResult["AUTH_URL"] ?>" name="bform" enctype="multipart/form-data">
                    <input type="hidden" name="AUTH_FORM" value="Y"/>
                    <input type="hidden" name="TYPE" value="REGISTRATION"/>

                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-label-container"><?= GetMessage("AUTH_NAME") ?></div>
                        <div class="bx-authform-input-container">
                            <input type="text" name="USER_NAME" maxlength="255" value="<?= $arResult["USER_NAME"] ?>"/>
                        </div>
                    </div>

                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-label-container"><?= GetMessage("AUTH_LAST_NAME") ?></div>
                        <div class="bx-authform-input-container">
                            <input type="text" name="USER_LAST_NAME" maxlength="255"
                                   value="<?= $arResult["USER_LAST_NAME"] ?>"/>
                        </div>
                    </div>

                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-label-container"><span
                                    class="bx-authform-starrequired">*</span><?= GetMessage("AUTH_LOGIN_MIN") ?></div>
                        <div class="bx-authform-input-container">
                            <input type="text" name="USER_LOGIN" maxlength="255"
                                   value="<?= $arResult["USER_LOGIN"] ?>"/>
                        </div>
                    </div>

                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-label-container"><span
                                    class="bx-authform-starrequired">*</span><?= GetMessage("AUTH_PASSWORD_REQ") ?>
                        </div>
                        <div class="bx-authform-input-container">
                            <? if ($arResult["SECURE_AUTH"]): ?>
                                <div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
                                    <div class="bx-authform-psw-protected-desc">
                                        <span></span><? echo GetMessage("AUTH_SECURE_NOTE") ?></div>
                                </div>

                                <script type="text/javascript">
                                    document.getElementById('bx_auth_secure').style.display = '';
                                </script>
                            <? endif ?>
                            <input type="password" name="USER_PASSWORD" maxlength="255"
                                   value="<?= $arResult["USER_PASSWORD"] ?>" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-label-container"><span
                                    class="bx-authform-starrequired">*</span><?= GetMessage("AUTH_CONFIRM") ?></div>
                        <div class="bx-authform-input-container">
                            <? if ($arResult["SECURE_AUTH"]): ?>
                                <div class="bx-authform-psw-protected" id="bx_auth_secure_conf" style="display:none">
                                    <div class="bx-authform-psw-protected-desc">
                                        <span></span><? echo GetMessage("AUTH_SECURE_NOTE") ?></div>
                                </div>

                                <script type="text/javascript">
                                    document.getElementById('bx_auth_secure_conf').style.display = '';
                                </script>
                            <? endif ?>
                            <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255"
                                   value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" autocomplete="off"/>
                        </div>
                    </div>

                    <? if ($arResult["EMAIL_REGISTRATION"]): ?>
                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-label-container"><? if ($arResult["EMAIL_REQUIRED"]): ?><span
                                        class="bx-authform-starrequired">*</span><? endif ?><?= GetMessage("AUTH_EMAIL") ?>
                            </div>
                            <div class="bx-authform-input-container">
                                <input type="text" name="USER_EMAIL" maxlength="255"
                                       value="<?= $arResult["USER_EMAIL"] ?>"/>
                            </div>
                        </div>
                    <? endif ?>

                    <? if ($arResult["PHONE_REGISTRATION"]): ?>
                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-label-container"><? if ($arResult["PHONE_REQUIRED"]): ?><span
                                        class="bx-authform-starrequired">*</span><? endif ?><? echo GetMessage("main_register_phone_number") ?>
                            </div>
                            <div class="bx-authform-input-container">
                                <input type="text" name="USER_PHONE_NUMBER" maxlength="255"
                                       value="<?= $arResult["USER_PHONE_NUMBER"] ?>"/>
                            </div>
                        </div>
                    <? endif ?>

                    <? if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
                        <? foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>

                            <div class="bx-authform-formgroup-container">
                                <div class="bx-authform-label-container"><? if ($arUserField["MANDATORY"] == "Y"): ?>
                                        <span class="bx-authform-starrequired">*</span><? endif ?><?= $arUserField["EDIT_FORM_LABEL"] ?>
                                </div>
                                <div class="bx-authform-input-container">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:system.field.edit",
                                        $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                        array(
                                            "bVarsFromForm" => $arResult["bVarsFromForm"],
                                            "arUserField" => $arUserField,
                                            "form_name" => "bform"
                                        ),
                                        null,
                                        array("HIDE_ICONS" => "Y")
                                    );
                                    ?>
                                </div>
      
                            </div>

                        <? endforeach; ?>

                    <? endif; ?>

                    <? $code = CMain::CaptchaGetCode(); ?>
                    <? if (isset($arResult["ERRORS"]["captcha"]) && $arResult["ERRORS"]["captcha"] != "") : ?>
                        <label class='order__windowsInputMessage error' for="singInPasswordRepeat"><?= $arResult["ERRORS"]["captcha"] ?></label>
                    <? endif; ?>
                    <div class="order__windowsInputItem order__windowsInputItem flexbox">
                        <label for="prop_<?= $prop["ID"] ?>" class="order__windowsInputTitle">Введите капчу*</label>
                        <div class="order__windowsInputBox order__windowsInputBox-short">
                            <input type="hidden" name="captcha_sid_<?= $type['ID'] ?>" value="<?= $code ?>" />
                            <label for="captchaUp" class="authorization__label"><?= GetMessage("CAPTCHA_REGF_PROMT") ?></label>
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $code ?>" width="180" height="40" alt="CAPTCHA" />
                            <input type="hidden" class="order__windowsInput " id="captchaUp" name="captcha_word_<?= $type['ID'] ?>" maxlength="50" value="" autocomplete="off" />
                        </div>
                    </div>

                    <script>
                        Recaptchafree.reset();
                    </script>
                    <? if ($arResult["USE_CAPTCHA"] == "Y"): /*?>
                        <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>

                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-label-container">
                                <span class="bx-authform-starrequired">*</span><?= GetMessage("CAPTCHA_REGF_PROMT") ?>
                            </div>
                            <div class="bx-captcha"><img
                                        src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                        width="180" height="40" alt="CAPTCHA"/></div>
                            <div class="bx-authform-input-container">
                                <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
                            </div>
                        </div>
                        
                    <? */endif ?>
                    <div class="bx-authform-formgroup-container">
                        <div class="bx-authform-label-container">
                        </div>
                        <div class="bx-authform-input-container">
                            <? $APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
                                array(
                                    "ID" => COption::getOptionString("main", "new_user_agreement", ""),
                                    "IS_CHECKED" => "Y",
                                    "AUTO_SAVE" => "N",
                                    "IS_LOADED" => "Y",
                                    "ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
                                    "ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
                                    "INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
                                    "REPLACE" => array(
                                        "button_caption" => GetMessage("AUTH_REGISTER"),
                                        "fields" => array(
                                            rtrim(GetMessage("AUTH_NAME"), ":"),
                                            rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
                                            rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
                                            rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
                                            rtrim(GetMessage("AUTH_EMAIL"), ":"),
                                        )
                                    ),
                                )
                            ); ?>
                        </div>
                    </div>
                    <div class="bx-authform-formgroup-container">
                        <input type="submit" class="btn btn-primary" name="Register"
                               value="<?= GetMessage("AUTH_REGISTER") ?>"/>
                    </div>

                    <hr class="bxe-light">

                    <div class="bx-authform-description-container">
                        <? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?>
                    </div>

                    <div class="bx-authform-description-container">
                        <span class="bx-authform-starrequired">*</span><?= GetMessage("AUTH_REQ") ?>
                    </div>

                    <div class="bx-authform-link-container">
                        <a href="<?= $arResult["AUTH_AUTH_URL"] ?>" rel="nofollow"><b><?= GetMessage("AUTH_AUTH") ?></b></a>
                    </div>

                </form>

                <script type="text/javascript">
                    document.bform.USER_NAME.focus();
                </script>

            <? endif ?>

        </noindex>
    </div>

<? endif; ?>

<script>
    Recaptchafree.reset();
</script>