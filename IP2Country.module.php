<?php

/**
 * Date: 04/02/14
 * Time: 15:58
 * Author: Jean-Christophe Cuvelier <jcc@morris-chapman.com>
 */
class IP2Country extends CMSModule
{

    public function GetFriendlyName()
    {
        return 'IP to Country';
    }

    public function GetAuthor()
    {
        return 'Jean-Christophe Cuvelier';
    }

    public function GetAuthorEmail()
    {
        return 'jcc@atomseeds.com';
    }

    public function GetVersion()
    {
        return '0.0.2';
    }

    public function GetHelp()
    {
        return $this->Lang('help');
    }

    public function MinimumCMSVersion()
    {
        return '1.11';
    }

    public function GetDependencies()
    {
        return array(
            'CMSForms' => '1.10.18',
            'MCFramework' => '0.0.1'
        );
    }

    public function HasAdmin()
    {
        return true;
    }

    public function GetAdminSection()
    {
        return 'extensions';
    }

    public function IsPluginModule()
    {
        return true;
    }

    public function CheckAccess()
    {
        return $this->CheckPermission('Manage IP2Country');
    }

    public function Install()
    {
        IPRange::createTable();
        $this->CreatePermission('Manage IP2Country', 'Allow management of IP to Country database');
        $this->RegisterModulePlugin(true);
    }

    public function Uninstall()
    {
        IPRange::deleteTable();
        $this->RemovePermission('Manage IP2Country');
    }
} 