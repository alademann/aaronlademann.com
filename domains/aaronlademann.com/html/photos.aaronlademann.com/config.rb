# =================================================
#   COMPASS CONFIG [SMUGMUG PHOTO SITE]
#   This config file is used to generate the
#   CSS for my SmugMug Photography Website
# =================================================

# default locations - compiled to produce style guide documentation 
  sass_dir          = "sass"
  css_dir           = "css"
  fonts_dir         = "fonts"
  images_dir        = "img"

  environment       = :production

  # compass compile -e development
    if environment != :production
      output_style          = :expanded
      line_comments         = true
    end

  # compass compile -e production
    if environment == :production
      output_style          = :compressed
      line_comments         = false
      disable_warnings      = true
        sass_options        = {:quiet => true}
    end

# To enable relative paths to assets via compass helper functions. Uncomment:
  relative_assets = true

# disable the asset cache buster
  asset_cache_buster :none


# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass lib scss && rm -rf sass && mv scss sass