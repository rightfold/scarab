{ stdenv, php }:
stdenv.mkDerivation rec {
    name = "psalm-${version}";
    version = "3.0.16";
    src = builtins.fetchurl {
        url = "https://github.com/vimeo/psalm/releases/download/${version}/psalm.phar";
        sha256 = "1b1r5z293670xw6brjz80274r7njcbqgdlnv12kiw3pbj3gqc9fm";
    };
    buildInputs = [php];
    phases = ["installPhase"];
    installPhase = ''
        mkdir -p $out/bin $out/share
        cp ${src} $out/share/psalm.phar
        cat <<EOF > "$out/bin/psalm"
        #!/bin/sh
        export PATH="${php}/bin:\$PATH"
        exec php $out/share/psalm.phar "\$@"
        EOF
        chmod +x $out/bin/psalm
    '';
}
