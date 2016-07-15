<?php

namespace spec\Snt\Capi\Repository\Article;

use PhpSpec\ObjectBehavior;
use Snt\Capi\PublicationId;
use Snt\Capi\Repository\Article\FindParameters;

/**
 * @mixin FindParameters
 */
class FindParametersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FindParameters::class);
    }

    function it_creates_find_parameters_for_publication_id_and_article_id()
    {
        $this->beConstructedThrough('createForPublicationIdAndArticleId', [PublicationId::SA, 1]);

        $this->getPublicationId()->shouldReturn(PublicationId::SA);
        $this->getArticleId()->shouldReturn(1);
    }

    function it_creates_find_parameters_for_publication_id_and_article_ids()
    {
        $this->beConstructedThrough('createForPublicationIdAndArticleIds', [PublicationId::SA, [1, 2, 3]]);

        $this->getPublicationId()->shouldReturn(PublicationId::SA);
        $this->getArticleIds()->shouldReturn([1, 2, 3]);
    }

    function it_creates_find_parameters_for_publication_id()
    {
        $this->beConstructedThrough('createForPublicationId', [PublicationId::FVN]);

        $this->getPublicationId()->shouldReturn(PublicationId::FVN);
    }

    function it_informs_when_article_id_is_present()
    {
        $this->beConstructedThrough('createForPublicationIdAndArticleId', [PublicationId::SA, 1]);

        $this->hasArticleId()->shouldReturn(true);
    }

    function it_informs_when_article_id_is_not_present()
    {
        $this->beConstructedThrough('createForPublicationIdAndArticleIds', [PublicationId::SA, [1, 2, 3, 4]]);

        $this->hasArticleId()->shouldReturn(false);
    }

    function it_builds_article_ids_as_a_string_with_comma_separator()
    {
        $this->beConstructedThrough('createForPublicationIdAndArticleIds', [PublicationId::SA, [1, 2, 3, 4]]);

        $this->buildArticleIdsString()->shouldReturn('1,2,3,4');
    }

    function it_builds_article_id_as_a_string_with_comma_separator()
    {
        $this->beConstructedThrough('createForPublicationIdAndArticleId', [PublicationId::SA, 1]);

        $this->buildArticleIdsString()->shouldReturn(1);
    }

    function it_builds_empty_string_when_only_publication_id_is_present()
    {
        $this->beConstructedThrough('createForPublicationId', [PublicationId::SA]);

        $this->buildArticleIdsString()->shouldReturn('');
    }
}