

select2
-----------------------------
<select class="form-control select2" data-toggle="select2" name="supplier_id" required>
known width issue?

@include('tenant.includes.js.select2')

https://stackoverflow.com/questions/45276778/select2-not-responsive-width-larger-than-container
https://stackoverflow.com/questions/12683907/set-the-width-of-select2-input-through-angular-ui-directive

sweetlater2 post confirmation
-----------------------------
where? sweet-alert2.txt 
D:\laravel\anypo\resources\views\landlord\admin\invoices\generate.blade.php
D:\laravel\anypo\resources\views\tenant\invoices\invoices\add-to-po.blade.php

don't put inside any DIV. Only TD
<td>
<select class="form-control select2" data-toggle="select2" name="supplier_id" required>
</td>
2. confirmation on scss compile



time ago
-----------------------------
@php
	$timeAgo = Carbon\Carbon::parse($comment->comment_date)->ago();
@endphp
{{ $timeAgo }}


attachment file type and max size?
-----------------------------
1.namespace App\Helpers\Tenant\FileUpload\aws
$request->validate(['file_to_upload'	=> 'required|file|mimes:eml,msg,zip,rar,doc,docx,xls,xlsx,pdf,jpg,png|max:2048']);

2. resources\views\components\tenant\attachment\create.blade.php


Sample email and cell number
-----------------------------
(123) 456-7890
(###) ###-####
(000) 000-0000
example.org, example.net and example.com
you@example.com [email@example.com]
'facebook'			=> 'https://www.facebook.com/my.anyponet',
'linkedin'			=> 'https://www.linkedin.com/company/anypo-net',

// in help page
akk.	'SUPPORT_PHONE_NO'		=> '+8801911310509',
The standard screen resolution size for most modern monitors is 1920 x 1080 pixels, also known as Full HD or 1080p. However, higher resolutions like 2560 x 1440 (1440p) and 3840 x 2160 (4K) are becoming more common.


Step 3: Autoloading the Helper File
----------------------------------------
composer.json

"autoload": {
	"files": [
		"app/Helpers/Tenant/Akk.php"
	],
	...
},

"files": "app/Helpers/Tenant/Akk.php",
 you need to run composer dump-autoload to make sure that everything has been loaded.

add function to all model like standard who and when column
-------------------------------------------------------------
trait CreatedUpdatedBy trait AddCreatedUpdatedBy
class DeptBudget extends Model
{
	use HasFactory, AddCreatedUpdatedBy,CreatedUpdatedBy;


get current domain
https://tenancyforlaravel.com/docs/v3/tenants/
dd(tenant()->domains->first()->domain);

number formated
----------------------------------
https://laracasts.com/discuss/channels/laravel/laravel-convert-amount-in-digit-to-words?page=1&replyId=124593
enable this extension in php.ini by uncommenting this line: extension=ext/php_intl.dll
$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
use Illuminate\Support\Number;
CpControler.php

echo $f->format(1432);
Log::debug(Number::spell(8));
Log::debug(Number::spell(9));
Log::debug(Number::spell(10));


tiemzone
https://qcode.in/managing-users-timezone-in-laravel-app/
$table->string('timezone', 60);



-- jquery dropdown select
calculate-invoice-amount.blade.php
PoController.php
InvoiceController.php
-- note make sure to enter key in the first select like po_id or supplier_id
$data = Invoice::select('id','currency','summary','supplier_id','po_id')->with('supplier:id,name')->with('po:id,summary')->where('id', $id)->first();
$data = Po::select('id','currency','supplier_id')->with('supplier:id,name')->where('id', $id)->first();


enum 
as alias both entity and user role
