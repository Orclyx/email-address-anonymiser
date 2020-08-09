<?php declare(strict_types=1);

namespace EmailAddressAnonymiser;

class Anonymiser
{
    protected KnownDomains $knownDomains;

    public function __construct()
    {
        $this->knownDomains = new KnownDomains();
    }

    public function anonymise(string $email): string
    {
        [$user, $domain] = explode('@', $email);

        if (strlen($user) === 1) {
            // Copy the 1st character. Must have 0 or >2
            $user[1] = $user[0];
        }

        if (strlen($user) !== 0) {
            $user = "{$user[0]}***{$user[strlen($user) - 1]}";
        }

        if (!$this->knownDomains->isKnown($domain)) {
            $domain = "{$domain[0]}***{$domain[strlen($domain) - 1]}";
        }

        return "{$user}@{$domain}";
    }
}
