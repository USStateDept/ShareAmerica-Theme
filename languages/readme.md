# ShareAmerica Translation

## Finding Translated Strings

Translations for ShareAmerica are handled in 3 places:

  * WPML String Translation
  * This directory
  * CSS

### WPML String Translation

WPML's [String Translation](https://wpml.org/documentation/getting-started-guide/string-translation/) plugin handles most of ShareAmerica's translations.

Any string changes to the files within the ```shareamerica/includes``` directory and within the Newspaper parent theme are handled by WPML String Translations.

### This Directory

This directory handles all the translated strings within the custom/modified templates of the ShareAmerica child theme, e.g. ```404.php```, ```footer.php```, and ```header.php```.

### CSS

A few other items, like the "Suggested for you" heading within posts, are handled by CSS.

## Generating the files in this directory

### Generating en_US.pot

To generate the en_US.pot file, from which the other language .po files are derived, do the following:

```bash
# Checkout Wordpress dev files
$ svn co http://develop.svn.wordpress.org/trunk/ wpcore

# Switch to i18n tools directory
$ cd wpcore/tools/i18n

# Run makepot.php
$ php makepot.php wp-theme /path/to/wp-content/themes/shareamerica en_US.pot
```

### Generating new .po files

1. Download [PoEdit](https://poedit.net/) and open it.
2. Select File > New from POT/PO file...
3. From the dialog window, locate your en_US.pot file and open it.
4. Then enter the language you need to translate and click OK.
5. Start entering your translations.
6. When you save, PoEdit will compile your .mo file.

### Updating an old .po file

1. Download [PoEdit](https://poedit.net/) and open it.
2. Select File > Open.
3. From the dialog window, locate the .po file you wish to edit.
4. To pull in new strings that you've added to your child theme templates, go to Catalog > Update from POT file...
5. Select en_US.pot, and your new strings should be brought into the file.
6. Translate and save.

## Resources

* [How to create .pot files with POedit?](http://wordpress.stackexchange.com/questions/149212/how-to-create-pot-files-with-poedit)
* [I18n for WordPress Developers](https://codex.wordpress.org/I18n_for_WordPress_Developers)
* [Wordpress Internationalization](https://developer.wordpress.org/themes/functionality/internationalization/)
* [Wordpress Localization](https://developer.wordpress.org/themes/functionality/localization/)
* [Polyglots channel on Slack](https://make.wordpress.org/chat/)
