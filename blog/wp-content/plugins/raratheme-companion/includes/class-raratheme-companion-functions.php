<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://raratheme.com
 * @since      1.0.0
 *
 * @package    Rara_Theme_Toolkit_Pro
 * @subpackage Rara_Theme_Toolkit_Pro/includes
 */
class RaraTheme_Companion_Functions {


	/**
     * List out font awesome icon list
    */
    function raratheme_companion_get_icon_list(){
        require RARATC_BASE_PATH . '/includes/assets/fontawesome.php';
        ?>
        <input type="text" class="rrtc-search-icon" placeholder="<?php _e('Search Icon','raratheme-companion');?>">
        <div class="rara-font-awesome-list">
    <?php
        echo '<ul class="rara-font-group">';
        foreach( $fontawesome as $font ){
            echo '<li><i class="fa ' . esc_attr( $font ) . '"></i></li>';
        }
        echo '</ul></div>';
    }

    function rtc_icon_list(){
        $fontawesome = array(  
           'fa-500px',
           'fa-adjust',
           'fa-adn',
           'fa-align-center',
           'fa-align-justify',
           'fa-align-left',
           'fa-align-right',
           'fa-amazon',
           'fa-ambulance',
           'fa-american-sign-language-interpreting',
           'fa-anchor',
           'fa-android',
           'fa-angellist',
           'fa-angle-double-down',
           'fa-angle-double-left',
           'fa-angle-double-right',
           'fa-angle-double-up',
           'fa-angle-down',
           'fa-angle-left',
           'fa-angle-right',
           'fa-angle-up',
           'fa-apple',
           'fa-archive',
           'fa-area-chart',
           'fa-arrow-circle-down',
           'fa-arrow-circle-left',
           'fa-arrow-circle-o-down',
           'fa-arrow-circle-o-left',
           'fa-arrow-circle-o-right',
           'fa-arrow-circle-o-up',
           'fa-arrow-circle-right',
           'fa-arrow-circle-up',
           'fa-arrow-down',
           'fa-arrow-left',
           'fa-arrow-right',
           'fa-arrow-up',
           'fa-arrows',
           'fa-arrows-alt',
           'fa-arrows-h',
           'fa-arrows-v',
           'fa-asl-interpreting',
           'fa-assistive-listening-systems',
           'fa-asterisk',
           'fa-at',
           'fa-audio-description',
           'fa-automobile',
           'fa-backward',
           'fa-balance-scale',
           'fa-ban',
           'fa-bandcamp',
           'fa-bank',
           'fa-bar-chart',
           'fa-bar-chart-o',
           'fa-barcode',
           'fa-bars',
           'fa-bath',
           'fa-bathtub',
           'fa-battery',
           'fa-battery-empty',
           'fa-battery-full',
           'fa-battery-half',
           'fa-battery-quarter',
           'fa-battery-three-quarters',
           'fa-bed',
           'fa-beer',
           'fa-behance',
           'fa-behance-square',
           'fa-bell',
           'fa-bell-o',
           'fa-bell-slash',
           'fa-bell-slash-o',
           'fa-bicycle',
           'fa-binoculars',
           'fa-birthday-cake',
           'fa-bitbucket',
           'fa-bitbucket-square',
           'fa-bitcoin',
           'fa-black-tie',
           'fa-blind',
           'fa-bluetooth',
           'fa-bluetooth-b',
           'fa-bold',
           'fa-bolt',
           'fa-bomb',
           'fa-book',
           'fa-bookmark',
           'fa-bookmark-o',
           'fa-braille',
           'fa-briefcase',
           'fa-btc',
           'fa-bug',
           'fa-building',
           'fa-building-o',
           'fa-bullhorn',
           'fa-bullseye',
           'fa-bus',
           'fa-buysellads',
           'fa-cab',
           'fa-calculator',
           'fa-calendar',
           'fa-calendar-check-o',
           'fa-calendar-minus-o',
           'fa-calendar-o',
           'fa-calendar-plus-o',
           'fa-calendar-times-o',
           'fa-camera',
           'fa-camera-retro',
           'fa-car',
           'fa-caret-down',
           'fa-caret-left',
           'fa-caret-right',
           'fa-caret-square-o-down',
           'fa-caret-square-o-left',
           'fa-caret-square-o-right',
           'fa-caret-square-o-up',
           'fa-caret-up',
           'fa-cart-arrow-down',
           'fa-cart-plus',
           'fa-cc',
           'fa-cc-amex',
           'fa-cc-diners-club',
           'fa-cc-discover',
           'fa-cc-jcb',
           'fa-cc-mastercard',
           'fa-cc-paypal',
           'fa-cc-stripe',
           'fa-cc-visa',
           'fa-certificate',
           'fa-chain',
           'fa-chain-broken',
           'fa-check',
           'fa-check-circle',
           'fa-check-circle-o',
           'fa-check-square',
           'fa-check-square-o',
           'fa-chevron-circle-down',
           'fa-chevron-circle-left',
           'fa-chevron-circle-right',
           'fa-chevron-circle-up',
           'fa-chevron-down',
           'fa-chevron-left',
           'fa-chevron-right',
           'fa-chevron-up',
           'fa-child',
           'fa-chrome',
           'fa-circle',
           'fa-circle-o',
           'fa-circle-o-notch',
           'fa-circle-thin',
           'fa-clipboard',
           'fa-clock-o',
           'fa-clone',
           'fa-close',
           'fa-cloud',
           'fa-cloud-download',
           'fa-cloud-upload',
           'fa-cny',
           'fa-code',
           'fa-code-fork',
           'fa-codepen',
           'fa-codiepie',
           'fa-coffee',
           'fa-cog',
           'fa-cogs',
           'fa-columns',
           'fa-comment',
           'fa-comment-o',
           'fa-commenting',
           'fa-commenting-o',
           'fa-comments',
           'fa-comments-o',
           'fa-compass',
           'fa-compress',
           'fa-connectdevelop',
           'fa-contao',
           'fa-copy',
           'fa-copyright',
           'fa-creative-commons',
           'fa-credit-card',
           'fa-credit-card-alt',
           'fa-crop',
           'fa-crosshairs',
           'fa-cube',
           'fa-cubes',
           'fa-cut',
           'fa-cutlery',
           'fa-dashboard',
           'fa-dashcube',
           'fa-database',
           'fa-deaf',
           'fa-deafness',
           'fa-dedent',
           'fa-delicious',
           'fa-desktop',
           'fa-deviantart',
           'fa-diamond',
           'fa-digg',
           'fa-dollar',
           'fa-dot-circle-o',
           'fa-download',
           'fa-dribbble',
           'fa-drivers-license',
           'fa-drivers-license-o',
           'fa-dropbox',
           'fa-drupal',
           'fa-edge',
           'fa-edit',
           'fa-eercast',
           'fa-eject',
           'fa-ellipsis-h',
           'fa-ellipsis-v',
           'fa-empire',
           'fa-envelope',
           'fa-envelope-o',
           'fa-envelope-open',
           'fa-envelope-open-o',
           'fa-envelope-square',
           'fa-envira',
           'fa-eraser',
           'fa-etsy',
           'fa-eur',
           'fa-euro',
           'fa-exchange',
           'fa-exclamation',
           'fa-exclamation-circle',
           'fa-exclamation-triangle',
           'fa-expand',
           'fa-expeditedssl',
           'fa-external-link',
           'fa-external-link-square',
           'fa-eye',
           'fa-eye-slash',
           'fa-eyedropper',
           'fa-fa',
           'fa-facebook',
           'fa-fast-backward',
           'fa-fast-forward',
           'fa-fax',
           'fa-feed',
           'fa-female',
           'fa-fighter-jet',
           'fa-file',
           'fa-file-archive-o',
           'fa-file-audio-o',
           'fa-file-code-o',
           'fa-file-excel-o',
           'fa-file-image-o',
           'fa-file-movie-o',
           'fa-file-o',
           'fa-file-pdf-o',
           'fa-file-photo-o',
           'fa-file-picture-o',
           'fa-file-powerpoint-o',
           'fa-file-sound-o',
           'fa-file-text',
           'fa-file-text-o',
           'fa-file-video-o',
           'fa-file-word-o',
           'fa-file-zip-o',
           'fa-files-o',
           'fa-film',
           'fa-filter',
           'fa-fire',
           'fa-fire-extinguisher',
           'fa-firefox',
           'fa-first-order',
           'fa-flag',
           'fa-flag-checkered',
           'fa-flag-o',
           'fa-flash',
           'fa-flask',
           'fa-flickr',
           'fa-floppy-o',
           'fa-folder',
           'fa-folder-o',
           'fa-folder-open',
           'fa-folder-open-o',
           'fa-font',
           'fa-font-awesome',
           'fa-fonticons',
           'fa-fort-awesome',
           'fa-forumbee',
           'fa-forward',
           'fa-foursquare',
           'fa-free-code-camp',
           'fa-frown-o',
           'fa-futbol-o',
           'fa-gamepad',
           'fa-gavel',
           'fa-gbp',
           'fa-ge',
           'fa-gear',
           'fa-gears',
           'fa-genderless',
           'fa-get-pocket',
           'fa-gg',
           'fa-gg-circle',
           'fa-gift',
           'fa-git',
           'fa-git-square',
           'fa-github',
           'fa-github-alt',
           'fa-github-square',
           'fa-gitlab',
           'fa-gittip',
           'fa-glass',
           'fa-glide',
           'fa-glide-g',
           'fa-globe',
           'fa-google',
           'fa-google-plus',
           'fa-google-wallet',
           'fa-graduation-cap',
           'fa-gratipay',
           'fa-grav',
           'fa-group',
           'fa-h-square',
           'fa-hacker-news',
           'fa-hand-grab-o',
           'fa-hand-lizard-o',
           'fa-hand-o-down',
           'fa-hand-o-left',
           'fa-hand-o-right',
           'fa-hand-o-up',
           'fa-hand-paper-o',
           'fa-hand-peace-o',
           'fa-hand-pointer-o',
           'fa-hand-rock-o',
           'fa-hand-scissors-o',
           'fa-hand-spock-o',
           'fa-hand-stop-o',
           'fa-handshake-o',
           'fa-hard-of-hearing',
           'fa-hashtag',
           'fa-hdd-o',
           'fa-header',
           'fa-headphones',
           'fa-heart',
           'fa-heart-o',
           'fa-heartbeat',
           'fa-history',
           'fa-home',
           'fa-hospital-o',
           'fa-hotel',
           'fa-hourglass',
           'fa-hourglass-end',
           'fa-hourglass-half',
           'fa-hourglass-o',
           'fa-hourglass-start',
           'fa-houzz',
           'fa-html',
           'fa-i-cursor',
           'fa-id-badge',
           'fa-id-card',
           'fa-id-card-o',
           'fa-ils',
           'fa-image',
           'fa-imdb',
           'fa-inbox',
           'fa-indent',
           'fa-industry',
           'fa-info',
           'fa-info-circle',
           'fa-inr',
           'fa-instagram',
           'fa-institution',
           'fa-internet-explorer',
           'fa-intersex',
           'fa-ioxhost',
           'fa-italic',
           'fa-joomla',
           'fa-jpy',
           'fa-jsfiddle',
           'fa-key',
           'fa-keyboard-o',
           'fa-krw',
           'fa-language',
           'fa-laptop',
           'fa-lastfm',
           'fa-lastfm-square',
           'fa-leaf',
           'fa-leanpub',
           'fa-legal',
           'fa-lemon-o',
           'fa-level-down',
           'fa-level-up',
           'fa-life-bouy',
           'fa-life-buoy',
           'fa-life-ring',
           'fa-life-saver',
           'fa-lightbulb-o',
           'fa-line-chart',
           'fa-link',
           'fa-linkedin',
           'fa-linode',
           'fa-linux',
           'fa-list',
           'fa-list-alt',
           'fa-list-ol',
           'fa-list-ul',
           'fa-location-arrow',
           'fa-lock',
           'fa-long-arrow-down',
           'fa-long-arrow-left',
           'fa-long-arrow-right',
           'fa-long-arrow-up',
           'fa-low-vision',
           'fa-magic',
           'fa-magnet',
           'fa-mail-forward',
           'fa-mail-reply',
           'fa-mail-reply-all',
           'fa-male',
           'fa-map',
           'fa-map-marker',
           'fa-map-o',
           'fa-map-pin',
           'fa-map-signs',
           'fa-mars',
           'fa-mars-double',
           'fa-mars-stroke',
           'fa-mars-stroke-h',
           'fa-mars-stroke-v',
           'fa-maxcdn',
           'fa-meanpath',
           'fa-medium',
           'fa-medkit',
           'fa-meetup',
           'fa-meh-o',
           'fa-mercury',
           'fa-microchip',
           'fa-microphone',
           'fa-microphone-slash',
           'fa-minus',
           'fa-minus-circle',
           'fa-minus-square',
           'fa-minus-square-o',
           'fa-mixcloud',
           'fa-mobile',
           'fa-mobile-phone',
           'fa-modx',
           'fa-money',
           'fa-moon-o',
           'fa-mortar-board',
           'fa-motorcycle',
           'fa-mouse-pointer',
           'fa-music',
           'fa-navicon',
           'fa-neuter',
           'fa-newspaper-o',
           'fa-object-group',
           'fa-object-ungroup',
           'fa-odnoklassniki',
           'fa-odnoklassniki-square',
           'fa-opencart',
           'fa-openid',
           'fa-opera',
           'fa-optin-monster',
           'fa-outdent',
           'fa-pagelines',
           'fa-paint-brush',
           'fa-paper-plane',
           'fa-paper-plane-o',
           'fa-paperclip',
           'fa-paragraph',
           'fa-paste',
           'fa-pause',
           'fa-pause-circle',
           'fa-pause-circle-o',
           'fa-paw',
           'fa-paypal',
           'fa-pencil',
           'fa-pencil-square',
           'fa-pencil-square-o',
           'fa-percent',
           'fa-phone',
           'fa-phone-square',
           'fa-photo',
           'fa-picture-o',
           'fa-pie-chart',
           'fa-pied-piper',
           'fa-pied-piper-alt',
           'fa-pied-piper-pp',
           'fa-pinterest',
           'fa-plane',
           'fa-play',
           'fa-play-circle',
           'fa-play-circle-o',
           'fa-plug',
           'fa-plus',
           'fa-plus-circle',
           'fa-plus-square',
           'fa-plus-square-o',
           'fa-podcast',
           'fa-power-off',
           'fa-print',
           'fa-product-hunt',
           'fa-puzzle-piece',
           'fa-qq',
           'fa-qrcode',
           'fa-question',
           'fa-question-circle',
           'fa-question-circle-o',
           'fa-quora',
           'fa-quote-left',
           'fa-quote-right',
           'fa-ra',
           'fa-random',
           'fa-ravelry',
           'fa-rebel',
           'fa-recycle',
           'fa-reddit',
           'fa-reddit-alien',
           'fa-reddit-square',
           'fa-refresh',
           'fa-registered',
           'fa-remove',
           'fa-renren',
           'fa-reorder',
           'fa-repeat',
           'fa-reply',
           'fa-reply-all',
           'fa-resistance',
           'fa-retweet',
           'fa-rmb',
           'fa-road',
           'fa-rocket',
           'fa-rotate-left',
           'fa-rotate-right',
           'fa-rouble',
           'fa-rss',
           'fa-rss-square',
           'fa-rub',
           'fa-ruble',
           'fa-rupee',
           'fa-s',
           'fa-safari',
           'fa-save',
           'fa-scissors',
           'fa-scribd',
           'fa-search',
           'fa-search-minus',
           'fa-search-plus',
           'fa-sellsy',
           'fa-send',
           'fa-send-o',
           'fa-server',
           'fa-share',
           'fa-share-alt',
           'fa-share-alt-square',
           'fa-share-square',
           'fa-share-square-o',
           'fa-shekel',
           'fa-sheqel',
           'fa-shield',
           'fa-ship',
           'fa-shirtsinbulk',
           'fa-shopping-bag',
           'fa-shopping-basket',
           'fa-shopping-cart',
           'fa-shower',
           'fa-sign-in',
           'fa-sign-language',
           'fa-sign-out',
           'fa-signal',
           'fa-signing',
           'fa-simplybuilt',
           'fa-sitemap',
           'fa-skyatlas',
           'fa-skype',
           'fa-slack',
           'fa-sliders',
           'fa-slideshare',
           'fa-smile-o',
           'fa-snapchat',
           'fa-snapchat-ghost',
           'fa-snapchat-square',
           'fa-snowflake-o',
           'fa-soccer-ball-o',
           'fa-sort',
           'fa-sort-alpha-asc',
           'fa-sort-alpha-desc',
           'fa-sort-amount-asc',
           'fa-sort-amount-desc',
           'fa-sort-asc',
           'fa-sort-desc',
           'fa-sort-down',
           'fa-sort-numeric-asc',
           'fa-sort-numeric-desc',
           'fa-sort-up',
           'fa-soundcloud',
           'fa-space-shuttle',
           'fa-spinner',
           'fa-spoon',
           'fa-spotify',
           'fa-square',
           'fa-square-o',
           'fa-stack-exchange',
           'fa-stack-overflow',
           'fa-star',
           'fa-star-half',
           'fa-star-half-empty',
           'fa-star-half-full',
           'fa-star-half-o',
           'fa-star-o',
           'fa-steam',
           'fa-steam-square',
           'fa-step-backward',
           'fa-step-forward',
           'fa-stethoscope',
           'fa-sticky-note',
           'fa-sticky-note-o',
           'fa-stop',
           'fa-stop-circle',
           'fa-stop-circle-o',
           'fa-street-view',
           'fa-strikethrough',
           'fa-stumbleupon',
           'fa-stumbleupon-circle',
           'fa-subscript',
           'fa-subway',
           'fa-suitcase',
           'fa-sun-o',
           'fa-superpowers',
           'fa-superscript',
           'fa-support',
           'fa-table',
           'fa-tablet',
           'fa-tachometer',
           'fa-tag',
           'fa-tags',
           'fa-tasks',
           'fa-taxi',
           'fa-telegram',
           'fa-television',
           'fa-tencent-weibo',
           'fa-terminal',
           'fa-text-height',
           'fa-text-width',
           'fa-th',
           'fa-th-large',
           'fa-th-list',
           'fa-themeisle',
           'fa-thermometer',
           'fa-thermometer-empty',
           'fa-thermometer-full',
           'fa-thermometer-half',
           'fa-thermometer-quarter',
           'fa-thermometer-three-quarters',
           'fa-thumb-tack',
           'fa-thumbs-down',
           'fa-thumbs-o-down',
           'fa-thumbs-o-up',
           'fa-thumbs-up',
           'fa-ticket',
           'fa-times',
           'fa-times-circle',
           'fa-times-circle-o',
           'fa-times-rectangle',
           'fa-times-rectangle-o',
           'fa-tint',
           'fa-toggle-down',
           'fa-toggle-left',
           'fa-toggle-off',
           'fa-toggle-on',
           'fa-toggle-right',
           'fa-toggle-up',
           'fa-trademark',
           'fa-train',
           'fa-transgender',
           'fa-transgender-alt',
           'fa-trash',
           'fa-trash-o',
           'fa-tree',
           'fa-trello',
           'fa-tripadvisor',
           'fa-trophy',
           'fa-truck',
           'fa-try',
           'fa-tty',
           'fa-tumblr',
           'fa-turkish-lira',
           'fa-tv',
           'fa-twitch',
           'fa-twitter',
           'fa-umbrella',
           'fa-underline',
           'fa-undo',
           'fa-universal-access',
           'fa-university',
           'fa-unlink',
           'fa-unlock',
           'fa-unlock-alt',
           'fa-unsorted',
           'fa-upload',
           'fa-usb',
           'fa-usd',
           'fa-user',
           'fa-user-circle',
           'fa-user-circle-o',
           'fa-user-md',
           'fa-user-o',
           'fa-user-plus',
           'fa-user-secret',
           'fa-user-times',
           'fa-users',
           'fa-vcard',
           'fa-vcard-o',
           'fa-venus',
           'fa-venus-double',
           'fa-venus-mars',
           'fa-viacoin',
           'fa-viadeo',
           'fa-video-camera',
           'fa-vimeo',
           'fa-vimeo-square',
           'fa-vine',
           'fa-vk',
           'fa-volume-control-phone',
           'fa-volume-down',
           'fa-volume-off',
           'fa-volume-up',
           'fa-warning',
           'fa-wechat',
           'fa-weibo',
           'fa-weixin',
           'fa-whatsapp',
           'fa-wheelchair',
           'fa-wheelchair-alt',
           'fa-wifi',
           'fa-wikipedia-w',
           'fa-window-close',
           'fa-window-close-o',
           'fa-window-maximize',
           'fa-window-minimize',
           'fa-window-restore',
           'fa-windows',
           'fa-won',
           'fa-wordpress',
           'fa-wpbeginner',
           'fa-wpexplorer',
           'fa-wpforms',
           'fa-wrench',
           'fa-xing',
           'fa-y-combinator',
           'fa-y-combinator-square',
           'fa-yahoo',
           'fa-yc',
           'fa-yc-square',
           'fa-yelp',
           'fa-yen',
           'fa-yoast',
           'fa-youtube',
        );
        return $fontawesome;
    }
    function rrtc_minify_js( $input ) {
      if(trim($input) === "") return $input;
      return preg_replace(
          array(
              // Remove comment(s)
              '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
              // Remove white-space(s) outside the string and regex
              '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
              // Remove the last semicolon
              '#;+\}#',
              // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
              '#([\{,])([\'])(\d+|[a-z_]\w*)\2(?=\:)#i',
              // --ibid. From `foo['bar']` to `foo.bar`
              '#([\w\)\]])\[([\'"])([a-z_]\w*)\2\]#i',
              // Replace `true` with `!0`
              '#(?<=return |[=:,\(\[])true\b#',
              // Replace `false` with `!1`
              '#(?<=return |[=:,\(\[])false\b#',
              // Clean up ...
              '#\s*(\/\*|\*\/)\s*#'
          ),
          array(
              '$1',
              '$1$2',
              '}',
              '$1$3',
              '$1.$3',
              '!0',
              '!1',
              '$1'
          ),
      $input);
  }


  function rrtc_minify_css( $input ) {
      if(trim($input) === "") return $input;
      // Force white-space(s) in `calc()`
      if(strpos($input, 'calc(') !== false) {
          $input = preg_replace_callback('#(?<=[\s:])calc\(\s*(.*?)\s*\)#', function($matches) {
              return 'calc(' . preg_replace('#\s+#', "\x1A", $matches[1]) . ')';
          }, $input);
      }
      return preg_replace(
          array(
              // Remove comment(s)
              '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
              // Remove unused white-space(s)
              '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
              // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
              '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
              // Replace `:0 0 0 0` with `:0`
              '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
              // Replace `background-position:0` with `background-position:0 0`
              '#(background-position):0(?=[;\}])#si',
              // Replace `0.6` with `.6`, but only when preceded by a white-space or `=`, `:`, `,`, `(`, `-`
              '#(?<=[\s=:,\(\-]|&\#32;)0+\.(\d+)#s',
              // Minify string value
              '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][-\w]*?)\2(?=[\s\{\}\];,])#si',
              '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
              // Minify HEX color code
              '#(?<=[\s=:,\(]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
              // Replace `(border|outline):none` with `(border|outline):0`
              '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
              // Remove empty selector(s)
              '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
              '#\x1A#'
          ),
          array(
              '$1',
              '$1$2$3$4$5$6$7',
              '$1',
              ':0',
              '$1:0 0',
              '.$1',
              '$1$3',
              '$1$2$4$5',
              '$1$2$3',
              '$1:0',
              '$1$2',
              ' '
          ),
      $input);
  }
    /**
     * List out font awesome icon list
    */
    function rtc_get_icon_list(){
        require RARATC_BASE_PATH . '/includes/assets/fontawesome.php';
        ?>
        <div class="rara-font-awesome-list">
    <?php
        $fontawesome = $this->rtc_icon_list();
        echo '<ul class="rara-font-group">';
        foreach( $fontawesome as $font ){
            echo '<li><i class="fa ' . esc_attr( $font ) . '"></i></li>';
        }
        echo '</ul></div>';
    }
    /**
     * Get an attachment ID given a URL.
     * 
     * @param string $url
     *
     * @return int Attachment ID on success, 0 on failure
     */
    function raratheme_companion_get_attachment_id( $url ) {
        $attachment_id = 0;
        $dir = wp_upload_dir();
        if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
            $file = basename( $url );
            $query_args = array(
                'post_type'   => 'attachment',
                'post_status' => 'inherit',
                'fields'      => 'ids',
                'meta_query'  => array(
                    array(
                        'value'   => $file,
                        'compare' => 'LIKE',
                        'key'     => '_wp_attachment_metadata',
                    ),
                )
            );
            $query = new WP_Query( $query_args );
            if ( $query->have_posts() ) {
                foreach ( $query->posts as $post_id ) {
                    $meta = wp_get_attachment_metadata( $post_id );
                    $original_file       = basename( $meta['file'] );
                    $cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
                    if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
                        $attachment_id = $post_id;
                        break;
                    }
                }
            }
        }
        return $attachment_id;
    }

    /**
     * Retrieves the image field.
     *  
     * @link https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
     */
    function raratheme_companion_get_image_field( $id, $name, $image, $label ){
        $output = '';
        $output .= '<div class="widget-upload">';
        $output .= '<label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label><br/>';
        $output .= '<input id="' . esc_attr( $id ) . '" class="rara-upload" type="hidden" name="' . esc_attr( $name ) . '" value="' . esc_attr( $image ) . '" placeholder="' . __('No file chosen', 'raratheme-companion') . '" />' . "\n";
        if ( function_exists( 'wp_enqueue_media' ) ) {
            if ( $image == '' ) {
                $output .= '<input id="upload-' . esc_attr( $id ) . '" class="rara-upload-button button" type="button" value="' . __('Upload', 'raratheme-companion') . '" />' . "\n";
            } else {
                $output .= '<input id="upload-' . esc_attr( $id ) . '" class="rara-upload-button button" type="button" value="' . __('Change', 'raratheme-companion') . '" />' . "\n";
            }
        } else {
            $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'raratheme-companion') . '</i></p>';
        }

        $output .= '<div class="rara-screenshot" id="' . esc_attr( $id ) . '-image">' . "\n";

        if ( $image != '' ) {
            $remove = '<a href="#" class="rara-remove-image">'.__('Remove Image','raratheme-companion').'</a>';
            $attachment_id = $image;
            $image_array = wp_get_attachment_image_src( $attachment_id, 'full');
            $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image_array[0]);
            if ( $image ) {
                $output .= '<img src="' . esc_url( $image_array[0] ) . '" alt="" />' . $remove;
            } else {
                // Standard generic output if it's not an image.
                $output .= '<small>' . __( 'Please upload valid image file.', 'raratheme-companion' ) . '</small>';
            }     
        }
        $output .= '</div></div>' . "\n";
        
        echo $output;
    }

	/**
	 * Get all the registered image sizes along with their dimensions
	 *
	 * @global array $_wp_additional_image_sizes
	 *
	 * @link http://core.trac.wordpress.org/ticket/18947 Reference ticket
	 * @return array $image_sizes The image sizes
	 */
	function raratheme_get_all_image_sizes() {
		global $_wp_additional_image_sizes;
		$default_image_sizes = array( 'thumbnail', 'medium', 'large', 'full' );
		 
		foreach ( $default_image_sizes as $size ) {
			$image_sizes[$size]['width']	= intval( get_option( "{$size}_size_w") );
			$image_sizes[$size]['height'] = intval( get_option( "{$size}_size_h") );
			$image_sizes[$size]['crop']	= get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}
		
		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) )
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
			
		return $image_sizes;
	}

    function raratheme_posted_on( $icon = false ) {
    
        echo '<span class="posted-on">';
        
        if( $icon ) echo '<i class="fa fa-calendar" aria-hidden="true"></i>';
        
        printf( '<a href="%1$s" rel="bookmark"><time class="entry-date published updated" datetime="%2$s">%3$s</time></a>', esc_url( get_permalink() ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
        
        echo '</span>';

    }
}
new RaraTheme_Companion_Functions;