# Email Address Anonymiser

Small PHP package to anonymise email addresses for storage or display.

The user side of the email address will always be transformed, but the domain will only be transformed if it is not
commonly used for personal email.

## Usage

```php
$anonymiser = new EmailAddressAnonymiser\Anonymiser();

// Becomes a***n@gmail.com
$out = $this->anonymiser->anonymise('admin@gmail.com');

// Becomes n***y@b***o
$out = $this->anonymiser->anonymise('no-reply@benyoung.io');
```

## CLI

You can use the `cli.php` script to anonymise email addresses via stdin. For example, given a file named `emails.txt`:
```
abc@example.org
admin@gmail.com
john.doe@example.com
no-reply@benyoung.io
root@googlemail.com
webmaster@hotmail.co.uk
webmaster@outlook.com
```
You can use the following one-liner to process each entry:
```
cat emails.txt | php cli.php > emails.anon.txt
``` 
Which produces `emails.anon.txt`:
```
a***c@e***g
a***n@gmail.com
j***e@e***m
n***y@b***o
r***t@googlemail.com
w***r@hotmail.co.uk
w***r@outlook.com
```
