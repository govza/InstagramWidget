--------------------
InstagramWidget
--------------------
Author: Rasul Abu Muhammad Amin <a href="http://govza.com">govza.com</a>
Feel free to suggest ideas/improvements/bugs on GitHub: <a href="http://github.com/govza/InstagramWidget/issues">http://github.com/govza/InstagramWidget/issues</a>
--------------------
## InstagramWidget
InstagramWidget is an Extra to display your Instagram photos, other users photos, hashtagged photos, user statistics on your website.
Make a gallery from Instagram photos, properties are customizable with wrapper and row tpl chunks.
Demo on <a href="http://inwidget.ru">http://inwidget.com/</a>

## Registration
Go to <a href="http://instagram.com/developer/clients/manage">http://instagram.com/developer/clients/manage</a>
Register New Client
copy Client ID

## How it Works
simple call
[[InstagramWidget? &id=`12345instagramID6789` &login=`instagram_user`]]
will display photos from instagram_user.

## Properties configuration
(required)
&id = `12345instagramID6789` required - don't use default on production it can be blocked by Instagram API.
&login =`login` required if you don't use hashtag property option.

(optional)
&hashtag = `modx` will get hashtagged photos from Instagram. Not user related.
&random =`1` random photos or last photos
&cacheExpTime = `6` cache time in hours

(templating default)
&width =`260px` widget width, could be number with 'px', or number with '%'.
&imageSize = `small` imagesize from Instagram used for thumbnails  'small', 'large', 'fullsize'.
&limit = `12` limit of retrieved and displayed images.
&inLine = `6` number of images in line

(templating advanced)
&cssFile = `/components/instagramwidget/css/instagramwidget.css` widget css file, use blank if you use custom styles and templating.
&wrapper = `tpl.Instagram.Widget.wrapper` wrapper tpl for widget.
&tpl = `tpl.Instagram.Widget.row` row tpl for widget.


## Information
This extra based on
	inWidget - free Instagram widget for your site!
	<a href="http://inwidget.ru">© Alexandr Kazarmshchikov"</a>

