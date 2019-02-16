{pkgs ? import ./nix/pkgs.nix {}}:
pkgs.stdenv.mkDerivation {
    name = "scarab";
    src = pkgs.lib.cleanSource ./.;
    buildInputs = [
        pkgs.php
        pkgs.phpPackages.composer
        pkgs.phpPackages.psalm
        pkgs.sassc
        pkgs.sqitchPg
    ];
    phases = ["unpackPhase" "buildPhase" "installPhase"];
    buildPhase = ''
        source 'build/build.bash'
    '';
    installPhase = ''
        source 'build/install.bash'
    '';
}
