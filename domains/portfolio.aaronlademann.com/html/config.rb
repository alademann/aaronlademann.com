#=================================================
#
#  Compass Sass Configuration File
#
#=================================================

# Compass Plugins
# ========================
  require "rgbapng"

# Project Properties
# ========================
  project_type = :stand_alone
  environment = :development


# Project Asset Structure
# ========================
  http_path = "/"
  css_dir = "public/css"
  fonts_dir = "public/fonts"
  sass_dir = "public/sass"
  images_dir = "public/images"
  javascripts_dir = "public/js"

# Compass Output Options
# ========================

# output_style = :expanded or :nested or :compact or :compressed
# use $ compass compile -e production --force to produce compressed css files for production.
	output_style = (environment == :production) ? :compact : :expanded	

# To enable relative paths to assets via compass helper functions. Uncomment:
  relative_assets = true
  # comment out relative_assets

# To disable debugging comments that display the original location of your selectors. Uncomment:
#  line_comments = false

# SASS Compiler Options
# ========================
#  sass_options = 

# SASS Functions
# ========================

  module Sass::Script::Functions
    
    #output a new hexidecimal string
    def hex_str(decimal)
      Sass::Script::String.new("%02x" % decimal)
    end

    #output a hexidecimal string for Internet Explorer's Alpha Filter Hacks
  	def ie_hex_str(color)
      assert_type color, :Color
      alpha = (color.alpha * 255).round.to_s(16).rjust(2, '0')
  		Sass::Script::String.new("##{alpha}#{color.send(:hex_str)[1..-1]}".upcase)	
  	end     
    declare :ie_hex_str, [:color]

  end
