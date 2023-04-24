<?php

namespace Thelia\Api\Resource;

abstract class AbstractTranslatableResource extends AbstractPropelResource implements TranslatableResourceInterface
{
    public I18nCollection $i18ns;

    public function __construct()
    {
        $this->i18ns = new I18nCollection();
    }

    public function setI18ns(array $i18ns): self
    {
        foreach ($i18ns as $locale => $i18n) {
            $i18nClass = $this->getI18nResourceClass();
            $this->i18ns->add((new $i18nClass($i18n)), $locale);
        }

        return $this;
    }

    public function addI18n(I18n $i18n, string $locale): self
    {
        $this->i18ns->add($i18n, $locale);

        return $this;
    }

    public function getI18ns(): I18nCollection
    {
        return $this->i18ns;
    }
}
