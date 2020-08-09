<?php declare(strict_types=1);

namespace EmailAddressAnonymiser;

/**
 * Lists of known domains originally sourced from the mailcheck.js library
 * @see https://github.com/mailcheck/mailcheck/blob/afca031b4ce1cdc6e3ecbe88198f41b4835f81e3/src/mailcheck.js
 */
class KnownDomains
{
    protected $knownDomains = [
        'aim.com',
        'aol.com',
        'att.net',
        'bellsouth.net',
        'btinternet.com',
        'charter.net',
        'comcast.net',
        'cox.net',
        'earthlink.net',
        'gmail.com',
        'google.com',
        'googlemail.com',
        'icloud.com',
        'mac.com',
        'me.com',
        'msn.com',
        'optonline.net',
        'optusnet.com.au',
        'qq.com',
        'rocketmail.com',
        'rogers.com',
        'sbcglobal.net',
        'shaw.ca',
        'sky.com',
        'sympatico.ca',
        'telus.net',
        'verizon.net',
        'web.de',
        'xtra.co.nz',
        'ymail.com',
    ];

    protected $knownSecondLevelDomains = [
        'gmx',
        'hotmail',
        'live',
        'mail',
        'outlook',
        'yahoo',
    ];

    protected $knownTopLevelDomains = [
        'at',
        'be',
        'biz',
        'ca',
        'ch',
        'co.il',
        'co.jp',
        'co.nz',
        'co.uk',
        'com',
        'com.au',
        'com.tw',
        'cz',
        'de',
        'dk',
        'edu',
        'es',
        'eu',
        'fr',
        'gov',
        'gr',
        'hk',
        'hu',
        'ie',
        'in',
        'info',
        'it',
        'jp',
        'kr',
        'mil',
        'net',
        'net',
        'net.au',
        'nl',
        'no',
        'org',
        'ru',
        'se',
        'sg',
        'uk',
        'us',
    ];

    public function isKnown(string $domain): bool
    {
        if (in_array($domain, $this->knownDomains)) {
            return true;
        }

        $components = array_reverse(explode('.', $domain));

        if (count($components) === 1) {
            return false;
        }

        if (count($components) > 2 &&
            in_array("{$components[1]}.{$components[0]}", $this->knownTopLevelDomains) &&
            in_array($components[2], $this->knownSecondLevelDomains)
        ) {
            return true;
        }

        if (count($components) > 1 &&
            in_array($components[0], $this->knownTopLevelDomains) &&
            in_array($components[1], $this->knownSecondLevelDomains)
        ) {
            return true;
        }

        return false;
    }
}
