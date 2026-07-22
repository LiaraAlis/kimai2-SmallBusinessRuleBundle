# Small business regulation bundle for Kimai
This Kimai plugin provides a function that makes it easy to use the small business regulation as it can be used in Germany and Austria.

## Features
* Adds a setting to enable the small business regulation globally.
* Disables VAT calculation for all invoices.
* Hides VAT in all default invoices.
* Adds a note to the invoice that the small business regulation is used.

## Requirements
This plugin is compatible with the following Kimai releases:

| Bundle version | Minimum Kimai version |
|----------------|-----------------------|
| 1.0            | 1.24                  |
| 2.0            | 2.0                   |
| 2.1.0          | 2.7                   |
| 2.2.0          | 2.45                  |

> **Upgrading from 2.1.0:** Kimai 2.41 changed how invoice templates handle VAT,
> which stopped this plugin from hiding the tax row. Kimai 2.45 added a public
> API for plugin-provided tax rates, which version 2.2.0 uses.
>
> This leaves Kimai 2.41 up to 2.44 without a working combination: plugin 2.1.0
> no longer hides the tax row there, and plugin 2.2.0 requires the API added in
> 2.45. Upgrading Kimai to 2.45 or newer is therefore required — on those
> releases your invoices still show a `VAT (0%)` row, which is wrong under the
> small business regulation: no VAT is levied at all, rather than VAT being
> charged at a rate of zero.
>
> Note that Kimai stores the rendered invoice documents in `var/data/invoices/`
> and does not re-render them later. Invoices created while running Kimai 2.41+
> together with plugin 2.1.0 keep the incorrect tax row. Check whether any of
> your archived invoices are affected and re-issue them if required.

## Installation
First clone this repository to your Kimai installation `plugins` directory:

```bash
cd var/plugins/
git clone https://github.com/LiaraAlis/kimai2-SmallBusinessRuleBundle.git SmallBusinessRuleBundle
```

Now you need to rebuild the cache, and you're ready to go!

```bash
bin/console kimai:reload --env=prod
```

To enable the small business regulation, go to the system settings and enable the checkbox in section `Invoices`. From now on, small business regulation is applied on all your invoices.
