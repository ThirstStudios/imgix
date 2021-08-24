# imgix
An ExpressionEngine addon to integrate with the Imgix image service. The plugin provides a simple integration with Imgix (https://imgix.com/) to change EE image URLs/paths into Imgix CDN urls with any transforms/image manipulations. It also allows you to setup reusable 'preset' manipulations (saving duplication in your code). 

The tag will work with any file field (ie EE native, Assets, etc) that outputs either a URL or path for the image.

## Requirements
- ExpressionEngine 5+
- PHP 7+
- An active Imgix account

## Installation
1. Copy the `imgix` folder to `system/user/addons/`
2. Install the module by going to the Add-On Manager, look for Imgix and click `Install`
3. Add the `$config['addon:imgix:imagix_url]` config setting to the `system\user\config\config.php` file

## Usage
This addon has 2 config options and 1 tag.

### Config options

#### $config['addon:imgix:imagix_url']

This config is *required*. Add in your Imgix domain url. The URL should include *https:\\*. You can learn how to create this url on the Imgix website (https://docs.imgix.com/setup/quick-start).
```
  $config['addon:imgix:imagix_url] = "https://mysite.imgix.net/"
```

#### $config['addon:imgix:presets']

This config is optional, and allows an array of preset image manipulations. The array key is the name of the preset, followed by the actual image manipulations.
```
  $config['addon:imgix:presets'] = array(
    "small" => "auto=format&w=50&h=20",
    "square" => "fit=crop&w=500&h=500&crop=center",
    "card" => "auto=format&w=800&fit=clip",
  );
```
### Tag

#### {exp:imgix}

The tag has 3 parameters.

##### src="{my_file_field}"

This parmeter is *required*. It can be the URL or path of the local image.

##### preset="name_of_preset"

If you want to use one of your preset manipulations (from the `$config['addon:imgix:presets']` array), add in the name of the preset.

##### params="auto=format&w=100"

Add in any manipulations you want! You can see options on the Imgix website (https://docs.imgix.com/apis/rendering).

### Examples

#### Params example

```
<img src="{exp:imgix src='{my_file_field}' params='auto=format&w=200&w=400&fit=clip'}" />
```

... or ...

```
{my_file_field}
<img src="{exp:imgix src='{url}' params='auto=format&w=200&w=400&fit=clip'}" />
{/my_file_field}
```

... will output ...

```
<img src="https://mysite.imgix.net/path/to/your/image.jpg?auto=format&w=200&w=400&fit=clip" />
```

#### Preset example

```
<img src="{exp:imgix src='{my_file_field}' preset='small'}" />
```

... or ...

```
{my_file_field}
<img src="{exp:imgix src='{url}' preset='small'}" />
{/my_file_field}
```

... will output ...

```
<img src="https://mysite.imgix.net/path/to/your/image.jpg?auto=format&w=50&h=20" />
```
