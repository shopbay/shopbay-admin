This folder stores all the theme resource files.

Each theme is represented as a directory consisting of view files, layout files, and relevant resource files such as images, CSS files, JavaScript files, etc.

The name of a theme is its directory name.


    ../resources/<theme>/views/<view files, layout files etc>


This is to follow the Yii theming framework.

The default theme root directory 'WebRoot/themes' is changed to this folder.

This is achieved by configuring the basePath and the baseUrl properties of the themeManager application component.


`site` folder is to house additional theme resources for own site use.

`shops` folder is to house additional theme resources contributed by third-parties for shops.

