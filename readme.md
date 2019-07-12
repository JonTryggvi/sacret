# from JT

Smá svona leiðbeiningar frá JT

1.  Þegar þið eruð búnir að pulla á local by flywheel má fara inní themes möppuna og gera
    git clone git@bitbucket.org:JonTryggviUnnarsson/aaa-blueprint.git some_name_we_like
    annars mun theme mappan heita aaa_blueprint sem er svo sem í lagi
  
2.  cd some_name_we_like og þegar við erum þar getum við gert npm install eða yarn install (ég mæli með yarn virðist vera stabílla)
3.  Hér er mikilvægt að skipta bara strax um git branch. Við viljum aldrei vinna á master branch
    git branch -m some_new_branch_name. Ég geri venjulega bara safe se ég breit síðar í eitthvað annað þegar kemur að því að pusha á origin.

4.  ef allt gekk vel má keyra skipunina gulp og vona það besta. 

5.  Chrome er stundum með vesen varðandi https og þá þarf að tryggja að flywheel sé stillt á trusted undir ssl stillingunni.



# Bones
A Lightweight Wordpress Development Theme

Bones is designed to make the life of developers easier. It's built
using HTML5 & has a strong semantic foundation.
It's constantly growing so be sure to check back often if you are a
frequent user. I'm always open to contribution. :)

Designed by Eddie Machado
http://themble.com/bones

License: WTFPL
License URI: http://sam.zoy.org/wtfpl/
Are You Serious? Yes.

#### Special Thanks to:
Paul Irish & the HTML5 Boilerplate
Yoast for some WP functions & optimization ideas
Andrew Rogers for code optimization
David Dellanave for speed & code optimization
and several other developers. :)

#### Submit Bugs & or Fixes:
https://github.com/eddiemachado/bones/issues

To view Release & Update Notes, read the CHANGELOG.md file in the main folder.

For more news and to see why my parents constantly ask me what I'm
doing with my life, follow me on twitter: @eddiemachado

## Helpful Tools & Links

Yeoman generator to quickly install Bones Wordpress starter theme into your Wordpress theme folder
by 0dp
https://github.com/0dp/generator-wp-bones


