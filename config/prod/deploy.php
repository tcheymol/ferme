<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

return new class extends DefaultDeployer {
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('www-data@155.133.130.79')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/var/www/ferme')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@github.com:tcheymol/ferme.git')
            // the repository branch to deploy
            ->repositoryBranch('main')
            ->sharedFilesAndDirs([
                '.env',
                'var/cache',
                'var/log',
                'var/sessions',
                'vendor/',
                'node_modules/',
                'public/bundles/',
            ]);
    }

    public function beforePreparing()
    {
        $this->log('Remote npm');
        $this->runRemote('npm install');
        $this->runRemote('npm run build');
    }

    public function beforeFinishingDeploy()
    {
        $this->runRemote('{{ console_bin }} doctrine:migrations:migrate -q');
    }

};
