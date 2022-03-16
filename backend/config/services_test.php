<?php
declare(strict_types=1);

use H2P\Application\Query\Public\User\UserRepository;
use H2P\Domain\Booking\BookingDataRepository;
use H2P\Domain\Booking\BookingService;
use H2P\Domain\Booking\CustomQuestions\CustomQuestionsService;
use H2P\Infrastructure\Cognito\TestCognitoUserRepository;
use H2P\Infrastructure\SES\TestSESComunicationService;
use H2P\Infrastructure\Timify\TestTimifyBookingDataService;
use H2P\Infrastructure\Timify\TestTimifyCustomQuestionsService;
use H2P\UI\Public\Security\CognitoUserProvider;
use H2P\UI\Public\Security\TestUserProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use \H2P\Domain\Comunication\ComunicationService;

$classToFileName = static fn (string $fqcn): string => (new ReflectionClass($fqcn))->getFileName();

return static function (ContainerConfigurator $configurator) use ($classToFileName): void
{
    $services = $configurator->services()
        ->defaults()
            ->public()
            ->autowire()
            ->autoconfigure()
    ;
};