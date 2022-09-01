# Small business regulation bundle for Kimai 2
This Kimai 2 plugin provides a function that makes it easy to use the small business regulation as it can be used in Germany and Austria.

## Features
* Adds a setting to enable the small business regulation globally.
* Disables VAT calculation for all invoices.
* Hides VAT in all default invoices.
* Adds a note to the invoice that the small business regulation is used.

## Requirements
This plugin is compatible with the following Kimai releases:

| Bundle version   | Minimum Kimai version |
|------------------|-----------------------|
| 1.0              | 1.23.1                |

## Installation
First clone this repository to your Kimai installation `plugins` directory:

```bash
cd var/plugins/
git clone https://github.com/LiaraAlis/kimai2-SmallBusinessRuleBundle.git
```

Now you need to rebuild the cache and you're ready to go!

```bash
bin/console kimai:reload --env=prod
```

To enable the small business regulation, go to the system settings and enable the checkbox in section `Small business rule`. From now on, small business regulation is applied on all your invoices.


## Important notes
### Own invoice templates
When using your own invoice template, you need to add the note manually. You can use the following snippet:
```html
{% if config('small_business_rule.enable') %}
<div class="small-business-rule-note">
    <p>{{ 'invoice.small_business_rule'|trans }}</p>
</div>
{% endif %}
```
