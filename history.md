hiqdev/yii2-cart
----------------

## [Under development]

    - [eb0aff7] 2016-07-17 fixed build [sol@hiqdev.com]
    - [e59e85b] 2016-07-17 fixed tests [sol@hiqdev.com]
    - [7961e9e] 2016-07-17 csfixed [sol@hiqdev.com]
    - [47689f5] 2016-07-16 csfixed [sol@hiqdev.com]
    - [bd63684] 2016-05-26 Fixed updating of item quantity in cart [d.naumenko.a@gmail.com]
    - [5857422] 2016-05-25 Added AddToCartAction::redirectToCart property [d.naumenko.a@gmail.com]
    - [29354ed] 2016-05-24 Updated translations [d.naumenko.a@gmail.com]
    - [cf4e1ed] 2016-05-20 Removed minii from composer.json [d.naumenko.a@gmail.com]
    - [e315640] 2016-04-18 translation [sol@hiqdev.com]
    - [5377886] 2016-04-15 Implemented CartPositionTrait::renderDescription() instead of concatenation in GridView [d.naumenko.a@gmail.com]
    - [89e7978] 2016-04-08 Add to CartController implements ViewContextInterface [andreyklochok@gmail.com]
    - [d3e1ad9] 2016-04-07 Fix usage help [andreyklochok@gmail.com]
    - [10efe68] 2016-03-21 Minor [d.naumenko.a@gmail.com]
    - [808461d] 2016-03-21 Added ShoppingCart::hasErrors() method [d.naumenko.a@gmail.com]
    - [a1afb99] 2016-03-21 CartPositionTrait - added getRowOptions method [d.naumenko.a@gmail.com]
    - [32a4471] 2016-03-21 Updated QuantityCell view to render result of Position::getQuantityOptions() if value is a string [d.naumenko.a@gmail.com]
    - [3b159ac] 2016-03-21 Updated translations [d.naumenko.a@gmail.com]
    - [d9b14cf] 2016-03-21 AddToCartAction updated to be able to handle both errored and ok positions [d.naumenko.a@gmail.com]
    - [fe44f81] 2016-03-17 Updated translations [d.naumenko.a@gmail.com]
    - [fb24a32] 2016-03-17 CartPositionTrait - added getModel() method [d.naumenko.a@gmail.com]
- Fixed minor issues
    - [ffc4e1c] 2016-03-04 translation [sol@hiqdev.com]
    - [2a44a12] 2016-02-04 fixed default Cart `_positions` to be [] <- null [sol@hiqdev.com]
    - [4e45fbb] 2016-02-03 + labels [sol@hiqdev.com]
    - [d5758fb] 2016-02-03 Add topcart action for topcart widget render by action [andreyklochok@gmail.com]
    - [df76673] 2016-02-02 AddToCartAction - spelling fix [d.naumenko.a@gmail.com]
    - [5b375c2] 2016-01-29 added tranlations [sol@hiqdev.com]
    - [a5b966e] 2016-01-20 AddToCartAction - fixed load bulk load of structured data [d.naumenko.a@gmail.com]
- Added bulk renewal
    - [053f3e8] 2016-01-18 AddToCartAction - code style fixes, PHPDoc updates [d.naumenko.a@gmail.com]
    - [9e490cd] 2016-01-18 Added HiArt dependency (must be removed later) [d.naumenko.a@gmail.com]
    - [41c1aaa] 2016-01-18 fixed build [sol@hiqdev.com]
    - [bc1ccf9] 2016-01-18 fixed build [sol@hiqdev.com]
    - [904f2b6] 2015-12-25 Module - added shoppingCartOptions property [d.naumenko.a@gmail.com]
    - [8982a03] 2015-12-25 ShoppingCart - PHPDocs improved [d.naumenko.a@gmail.com]
    - [06670cf] 2015-12-25 CartController::actionUpdateQuantity - fixed broken redirect [d.naumenko.a@gmail.com]
    - [69b9a1f] 2015-12-22 Add bulk Renewal [andreyklochok@gmail.com]
    - [9820938] 2015-12-22 Some changes [andreyklochok@gmail.com]
- Added configration options to Module
    - [5cc02b9] 2015-12-15 added test for get/setOrderButton [sol@hiqdev.com]
    - [213c03b] 2015-12-15 fixed travis and tests [sol@hiqdev.com]
    - [112713c] 2015-12-04 + Amount due [sol@hiqdev.com]
    - [3435f56] 2015-12-01 + `orderButton` parameter [sol@hiqdev.com]
    - [c916a79] 2015-12-01 added `orderPage` option to Module [sol@hiqdev.com]
    - [baeab52] 2015-11-30 fixed testCreateUrl [sol@hiqdev.com]
    - [0561eda] 2015-11-30 added parametrization of payment methods [sol@hiqdev.com]
    - [59e0dca] 2015-11-19 Add toggled checkbox on the checkout page [andreyklochok@gmail.com]
    - [8684813] 2015-11-19 Replace `$model->quantity` to `$model->getQuantity()` !?!?!? [andreyklochok@gmail.com]
- Added phpdocs, testing and Travis CI
    - [374c80c] 2015-12-16 Added PHPDoc, refactoring [d.naumenko.a@gmail.com]
    - [dea6779] 2015-11-30 redone createUrl <- buildUrl [sol@hiqdev.com]
    - [592d76b] 2015-11-26 php-cs-fixed [sol@hiqdev.com]
    - [d5222e4] 2015-11-26 added more tests and coverage [sol@hiqdev.com]
    - [890a509] 2015-11-26 + testBuildUrl [sol@hiqdev.com]
    - [f96a35a] 2015-11-25 php-cs-fixed [sol@hiqdev.com]
    - [95e1f6b] 2015-11-25 added testing and Travis CI [sol@hiqdev.com]
- Added local ShoppingCart components
    - [0a0f955] 2015-11-16 Module.php - fixed syntax error [d.naumenko.a@gmail.com]
    - [9ded1e8] 2015-11-16 php-cs-fixed [sol@hiqdev.com]
    - [670eca8] 2015-11-16 fixed minor issues [sol@hiqdev.com]
    - [a37e935] 2015-11-16 + CartPosition Trait and Interface [sol@hiqdev.com]
    - [b291ca2] 2015-11-16 minor fixes [sol@hiqdev.com]
    - [8baf894] 2015-11-13 php-cs-fixed [sol@hiqdev.com]
    - [c2454e4] 2015-11-13 added local ShoppingCart component with currency formatting and used all over [sol@hiqdev.com]
- Added translations
    - [b42d164] 2015-12-07 translations [sol@hiqdev.com]
    - [eba9f25] 2015-11-13 added translations [sol@hiqdev.com]
- Changed: redone to yii2-cart
    - [879a12c] 2015-11-12 php-cs-fixed [sol@hiqdev.com]
    - [3dc05b9] 2015-11-12 basically fixed [sol@hiqdev.com]
    - [859bc0c] 2015-11-12 redoing to yii2-cart [sol@hiqdev.com]
- Added basics
    - [bd6c9ed] 2015-11-13 + terms of use checkbox (not finished) [sol@hiqdev.com]
    - [cbca0b2] 2015-11-10 fix mistakes in sentences [bladeroot@gmail.com]
    - [473b3fc] 2015-10-28 Add change quantity functionality in cart index grid [andreyklochok@gmail.com]
    - [1e49467] 2015-10-27 Work at cart [andreyklochok@gmail.com]
    - [c041e59] 2015-10-26 Add QuantityColumn [andreyklochok@gmail.com]
    - [faf5a2c] 2015-10-26 getId redefine for Renewal [andreyklochok@gmail.com]
    - [8e036f2] 2015-10-23 Work at cart functionality [andreyklochok@gmail.com]
    - [b678fd5] 2015-10-23 Add top cart postions render [andreyklochok@gmail.com]
    - [84b96bb] 2015-10-23 Add Cart Clear button [andreyklochok@gmail.com]
    - [9b11091] 2015-10-23 Add actions to CartController, create index page, fix TopCart [andreyklochok@gmail.com]
    - [2f9d375] 2015-10-22 Add index view [andreyklochok@gmail.com]
    - [73f9ed8] 2015-10-22 work at topcart widget [andreyklochok@gmail.com]
    - [2fe2c28] 2015-10-22 Fix. Remove comma from from composer.json [andreyklochok@gmail.com]
    - [4fda2b1] 2015-10-22 Add module Cart. Add TopCart widget [andreyklochok@gmail.com]
    - [3c2385e] 2015-10-21 php-cs-fixed [sol@hiqdev.com]
    - [42da165] 2015-10-21 inited [sol@hiqdev.com]

## [Development started] - 2015-10-21

[ffc4e1c]: https://github.com/hiqdev/yii2-cart/commit/ffc4e1c
[2a44a12]: https://github.com/hiqdev/yii2-cart/commit/2a44a12
[4e45fbb]: https://github.com/hiqdev/yii2-cart/commit/4e45fbb
[d5758fb]: https://github.com/hiqdev/yii2-cart/commit/d5758fb
[df76673]: https://github.com/hiqdev/yii2-cart/commit/df76673
[5b375c2]: https://github.com/hiqdev/yii2-cart/commit/5b375c2
[a5b966e]: https://github.com/hiqdev/yii2-cart/commit/a5b966e
[053f3e8]: https://github.com/hiqdev/yii2-cart/commit/053f3e8
[9e490cd]: https://github.com/hiqdev/yii2-cart/commit/9e490cd
[41c1aaa]: https://github.com/hiqdev/yii2-cart/commit/41c1aaa
[bc1ccf9]: https://github.com/hiqdev/yii2-cart/commit/bc1ccf9
[904f2b6]: https://github.com/hiqdev/yii2-cart/commit/904f2b6
[8982a03]: https://github.com/hiqdev/yii2-cart/commit/8982a03
[06670cf]: https://github.com/hiqdev/yii2-cart/commit/06670cf
[69b9a1f]: https://github.com/hiqdev/yii2-cart/commit/69b9a1f
[9820938]: https://github.com/hiqdev/yii2-cart/commit/9820938
[5cc02b9]: https://github.com/hiqdev/yii2-cart/commit/5cc02b9
[213c03b]: https://github.com/hiqdev/yii2-cart/commit/213c03b
[112713c]: https://github.com/hiqdev/yii2-cart/commit/112713c
[3435f56]: https://github.com/hiqdev/yii2-cart/commit/3435f56
[c916a79]: https://github.com/hiqdev/yii2-cart/commit/c916a79
[baeab52]: https://github.com/hiqdev/yii2-cart/commit/baeab52
[0561eda]: https://github.com/hiqdev/yii2-cart/commit/0561eda
[59e0dca]: https://github.com/hiqdev/yii2-cart/commit/59e0dca
[8684813]: https://github.com/hiqdev/yii2-cart/commit/8684813
[374c80c]: https://github.com/hiqdev/yii2-cart/commit/374c80c
[dea6779]: https://github.com/hiqdev/yii2-cart/commit/dea6779
[592d76b]: https://github.com/hiqdev/yii2-cart/commit/592d76b
[d5222e4]: https://github.com/hiqdev/yii2-cart/commit/d5222e4
[890a509]: https://github.com/hiqdev/yii2-cart/commit/890a509
[f96a35a]: https://github.com/hiqdev/yii2-cart/commit/f96a35a
[95e1f6b]: https://github.com/hiqdev/yii2-cart/commit/95e1f6b
[0a0f955]: https://github.com/hiqdev/yii2-cart/commit/0a0f955
[9ded1e8]: https://github.com/hiqdev/yii2-cart/commit/9ded1e8
[670eca8]: https://github.com/hiqdev/yii2-cart/commit/670eca8
[a37e935]: https://github.com/hiqdev/yii2-cart/commit/a37e935
[b291ca2]: https://github.com/hiqdev/yii2-cart/commit/b291ca2
[8baf894]: https://github.com/hiqdev/yii2-cart/commit/8baf894
[c2454e4]: https://github.com/hiqdev/yii2-cart/commit/c2454e4
[b42d164]: https://github.com/hiqdev/yii2-cart/commit/b42d164
[eba9f25]: https://github.com/hiqdev/yii2-cart/commit/eba9f25
[879a12c]: https://github.com/hiqdev/yii2-cart/commit/879a12c
[3dc05b9]: https://github.com/hiqdev/yii2-cart/commit/3dc05b9
[859bc0c]: https://github.com/hiqdev/yii2-cart/commit/859bc0c
[bd6c9ed]: https://github.com/hiqdev/yii2-cart/commit/bd6c9ed
[cbca0b2]: https://github.com/hiqdev/yii2-cart/commit/cbca0b2
[473b3fc]: https://github.com/hiqdev/yii2-cart/commit/473b3fc
[1e49467]: https://github.com/hiqdev/yii2-cart/commit/1e49467
[c041e59]: https://github.com/hiqdev/yii2-cart/commit/c041e59
[faf5a2c]: https://github.com/hiqdev/yii2-cart/commit/faf5a2c
[8e036f2]: https://github.com/hiqdev/yii2-cart/commit/8e036f2
[b678fd5]: https://github.com/hiqdev/yii2-cart/commit/b678fd5
[84b96bb]: https://github.com/hiqdev/yii2-cart/commit/84b96bb
[9b11091]: https://github.com/hiqdev/yii2-cart/commit/9b11091
[2f9d375]: https://github.com/hiqdev/yii2-cart/commit/2f9d375
[73f9ed8]: https://github.com/hiqdev/yii2-cart/commit/73f9ed8
[2fe2c28]: https://github.com/hiqdev/yii2-cart/commit/2fe2c28
[4fda2b1]: https://github.com/hiqdev/yii2-cart/commit/4fda2b1
[3c2385e]: https://github.com/hiqdev/yii2-cart/commit/3c2385e
[42da165]: https://github.com/hiqdev/yii2-cart/commit/42da165
[eb0aff7]: https://github.com/hiqdev/yii2-cart/commit/eb0aff7
[e59e85b]: https://github.com/hiqdev/yii2-cart/commit/e59e85b
[7961e9e]: https://github.com/hiqdev/yii2-cart/commit/7961e9e
[47689f5]: https://github.com/hiqdev/yii2-cart/commit/47689f5
[bd63684]: https://github.com/hiqdev/yii2-cart/commit/bd63684
[5857422]: https://github.com/hiqdev/yii2-cart/commit/5857422
[29354ed]: https://github.com/hiqdev/yii2-cart/commit/29354ed
[cf4e1ed]: https://github.com/hiqdev/yii2-cart/commit/cf4e1ed
[e315640]: https://github.com/hiqdev/yii2-cart/commit/e315640
[5377886]: https://github.com/hiqdev/yii2-cart/commit/5377886
[89e7978]: https://github.com/hiqdev/yii2-cart/commit/89e7978
[d3e1ad9]: https://github.com/hiqdev/yii2-cart/commit/d3e1ad9
[10efe68]: https://github.com/hiqdev/yii2-cart/commit/10efe68
[808461d]: https://github.com/hiqdev/yii2-cart/commit/808461d
[a1afb99]: https://github.com/hiqdev/yii2-cart/commit/a1afb99
[32a4471]: https://github.com/hiqdev/yii2-cart/commit/32a4471
[3b159ac]: https://github.com/hiqdev/yii2-cart/commit/3b159ac
[d9b14cf]: https://github.com/hiqdev/yii2-cart/commit/d9b14cf
[fe44f81]: https://github.com/hiqdev/yii2-cart/commit/fe44f81
[fb24a32]: https://github.com/hiqdev/yii2-cart/commit/fb24a32
